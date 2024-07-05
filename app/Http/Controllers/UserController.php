<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Config;
use App\Models\InvestmentHistory;
use App\Models\ClaimHistory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserController extends Controller
{
    public function register(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'telegram_id' => 'required|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'firstname' => 'nullable|string|max:255',
            'referral_by' => 'nullable',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }


        try {
            $dateTime = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());

            // Convert the datetime to a timestamp
            $timestamp = $dateTime->timestamp;

            // Find existing user by telegram_id or create a new one
            $user = User::firstOrCreate(
                [
                    'telegram_id' => $request->input('telegram_id'),
                ],
                [
                    'telegram_id' => $request->input('telegram_id'),
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'referral_by' => $request->input('referral_by'),
                    'join_date' => $timestamp
                ]
            );


            // dd($user);

            return response()->json(['user' => $user], 201);
        } catch (\Exception $e) {

            // Optionally handle the exception
            return response()->json(['register' => 'Register failed'], 500);
        }
    }
    public function claimDailyAmount(Request $request)
    {

        // Find the user
        $id = $request->telegram_id;

        $user = User::findOrFail($id);
        $currentDate = Carbon::now();
        $user_investment = InvestmentHistory::where('telegram_id', $user->telegram_id)->get();
        foreach ($user_investment as $investment) {

            $user_investment = $investment->amount;
        }

        // Retrieve the last claim history for the user
        $lastClaim = $user->claimHistories()->latest()->first();
        if ($lastClaim) {
            // Last claim date found
            $lastClaimDate = $lastClaim->claimed_at;
        } else {
            //User join date
            $lastClaimDate = $user->join_date;
        }
        $Config_detail = Config::first();
        $paid_daily_roi = $Config_detail->daily_roi;

        $dateTime = Carbon::createFromFormat('Y-m-d H:i:s', $currentDate);
        $timestamp = $dateTime->timestamp;

        // timestamp convert date and time 
        $old_date = Carbon::createFromTimestamp($lastClaimDate);

        $differenceInSeconds = $old_date->diffInSeconds($currentDate);


        $free_packeg_amount = 1 / 86400 * $differenceInSeconds;
        $paid_packeg_daliy_roi = $user_investment * $paid_daily_roi  / 100;
        $total_roi = $free_packeg_amount + $paid_packeg_daliy_roi;


        dd($total_roi);
        // Update user's wallet and create claim history
        $user->wallet += $total_roi;
        $user->save();


        ClaimHistory::create([
            'telegram_id' => $user->telegram_id,
            'user_id' => $user->id,
            'amount' => $total_roi,
            'claimed_at' => $timestamp,
        ]);

        return response()->json([
            'message' => 'Daily claim processed successfully.',
            'user' => $user,
            'claim_amount' => $total_roi,
        ]);
    }

    public function invest(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'telegram_id' => 'required',
            'amount' => 'required|numeric',
            'tx_hash' => 'nullable',
            'order_id' => 'nullable',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $dateTime = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());

        // Convert the datetime to a timestamp
        $timestamp = $dateTime->timestamp;

        $investmentHistory = InvestmentHistory::create([
            'user_id' => $request->input('user_id'),
            'telegram_id' => $request->input('telegram_id'),
            'amount' => $request->input('amount'),
            'type' => $request->input('type'),
            'tx_hash' => $request->input('tx_hash'),
            'order_id' => $request->input('order_id'),
            'invest_at' => $timestamp,
        ]);

        return response()->json(['investment_history' => $investmentHistory], 404);
    }
}
