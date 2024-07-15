<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Config;
use App\Models\InvestmentHistory;
use App\Models\TransactionHistory;

use App\Models\ClaimHistory;
use App\Models\Address;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Level;
use Illuminate\Support\Facades\Log;

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



            $user = User::where('telegram_id', $request->telegram_id)->first();

            if ($user) {
                $user = $user;

                $this->claimDaily($user);
            } else {

                $user = User::create([
                    'telegram_id' => $request->input('telegram_id'),
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'referral_by' => $request->input('referral_by'),
                    'join_date' => $timestamp,
                    'last_claim_timestamp' => $timestamp

                ]);

                $investmentHistory = InvestmentHistory::create([
                    'user_id' => $user->id,
                    'amount' => 20,
                    'address' => null,
                    'invest_at' => $timestamp,
                ]);
            }



            return response()->json(['user' => $user], 200);
        } catch (\Exception $e) {

            // Optionally handle the exception
            return response()->json(['register' => 'Register failed'], 500);
        }
    }
    public function claimDailyAmount(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        // dd($request->user_id);
        $data = $this->claimDaily($user);
        // dd($data);


        $dateTime = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());
        $timestamp = $dateTime->timestamp;


        ClaimHistory::create([
            'telegram_id' => $user->telegram_id,
            'user_id' => $user->id,
            'amount' => $data->claimable_amt,
            'last_claim_timestamp' => $timestamp,
        ]);
        $user->wallet += $data->claimable_amt;
        $user->claimable_amt = 0;
        $user->save();

        return response()->json([
            'message' => 'Daily claim processed successfully.',
            'user' => $user,
            'claim_amount' => $data->claimable_amt,
        ]);
    }

    public function invest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'address' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $dateTime = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());

        // Convert the datetime to a timestamp
        $timestamp = $dateTime->timestamp;

        DB::beginTransaction();

        try {

            $investmentHistory = InvestmentHistory::create([
                'user_id' => $request->input('user_id'),
                'amount' => $request->input('amount'),
                'address' => $request->input('address'),
                'invest_at' => $timestamp,
            ]);

            //user change status 2 = Paid Packeg
            $user = User::findOrFail($request->input('user_id'));
            $levels = Level::all();
            // dd($levels);
            $currentUser = $user;
            Log::info('Initial user data:', ['currentUser' => $currentUser->toArray()]);

            foreach ($levels as $level) {
                // dd($levels);
                if ($currentUser && $currentUser->referral_by) {
                    $referrer = User::where('telegram_id', $currentUser->referral_by)->first();
                    if (!$referrer) {
                        Log::warning('Referrer not found', ['referral_by' => $currentUser->referral_by]);
                        break;
                    }
                    // echo 'level', $level->level;
                    $bonusAmount = $request->input('amount') * $level->level / 100;
                    $referrer->wallet += $bonusAmount;
                    $referrer->save();

                    $TransactionHistory =  TransactionHistory::create([
                        'amount' => $bonusAmount,
                        'level' => $level->level,
                        'to' => $referrer->id,
                        'by' => $user->id,
                        'type' => "2"
                    ]);
                    // dd($TransactionHistory);
                    echo 'TransactionHistory', $TransactionHistory;
                    $currentUser = $referrer;
                    // echo 'curent_user', $currentUser;
                    // Log::info('Updated user data:', ['currentUser' => $currentUser->toArray()]);
                } else {
                    Log::warning('Referrer not found or currentUser is invalid', ['currentUser' => $currentUser]);
                    break;
                }
            }
            // dd($currentUser);



            $user->status = 2;
            $user->save();
            //update user_id and amount in address table
            $address = Address::get();

            foreach ($address as $address) {
                if ($address->user_id !== null) {
                    $address->user_id = $request->input('user_id');
                    $address->amount = $request->input('amount');
                    $address->save();
                }
            }



            DB::commit();
            return response()->json(['investment_history' => $investmentHistory], 200);
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();

            return response()->json(['success' => false, 'message' => 'Error occurred: ' . $e->getMessage()]);
        }
    }

    public function order_details(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',


        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $address = Address::first();
        $daily_Roi = config::first();
        $daily_profit = $daily_Roi->daily_roi;  // 5% daily profit
        $rent_period = 30;
        $total_profit = $request->amount * $daily_profit * $rent_period / 100;
        $mining_power = $request->amount / 10;

        // dd($request->user_id);
        $address->amount = $request->user_id;
        $address->save();

        return response()->json(
            [
                'paymentAddress' => $address->address,
                'miningPower' => $mining_power,
                'rentPeriod'  => $rent_period,
                'Total totalProfit'  => $total_profit,
                'dailyProfit'  => $daily_profit,
                'price'  => $request->amount

            ],
            200
        );
    }

    public function transactions(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'type'  => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $transactions = TransactionHistory::where('to', $request->user_id)->get();

        // Prepare an array to hold the formatted transaction data
        $formattedTransactions = [];

        // Iterate over each transaction and format the data
        foreach ($transactions as $transaction) {
            $formattedTransactions[] = [
                'to' => $transaction->to,
                'by' => $transaction->by,
                'amount' => $transaction->amount,
                'type' => $transaction->type,
                'created_at' => $transaction->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $transaction->updated_at->format('Y-m-d H:i:s'),
            ];
        }

        // Return the formatted transactions as JSON response
        return response()->json($formattedTransactions, 200);
    }

    private function claimDaily($user)
    {

        $id = $user->id;

        $currentDate = Carbon::now();
        $Config_detail = Config::first();
        $paid_daily_roi = $Config_detail->daily_roi;
        $lastClaim = $user->claimHistories()->latest()->first();

        $user_investment = InvestmentHistory::where('user_id', $id)->get();
        $user = User::findOrFail($id);

        $claim_amount = 0;

        foreach ($user_investment as $investment) {

            $investment_amount = $investment->amount;
            // dd($claim_amount);

            if ($investment->invest_at > $lastClaim) {
                // Last claim date found

                $lastClaimDate = $investment->invest_at;
            } else {



                $lastClaimDate = $lastClaim->last_claim_timestamp;
            }

            $old_date = Carbon::createFromTimestamp($lastClaimDate);

            $differenceInSeconds = $old_date->diffInSeconds($currentDate);



            $one_day_roi = $investment_amount * $paid_daily_roi  / 100;
            $investment_claim_amount  = $one_day_roi / 86400 * $differenceInSeconds;

            $claim_amount += $investment_claim_amount;
        }

        $user->claimable_amt = $claim_amount;
        $user->save();

        return $user;
    }
}
