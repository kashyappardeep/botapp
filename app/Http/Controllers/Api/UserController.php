<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\Config;
use App\Models\InvestmentHistory;
use App\Models\TransactionHistory;
use App\Models\Withdraw;
use App\Models\LinkVerify;
use App\Models\ContentData;

use App\Models\ClaimHistory;
use App\Models\Address;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Level;
use App\Models\UserTask;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required|max:255',
            'last_name' => 'nullable|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'referral_by' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $referral_by = $request->referral_by;
        if ($referral_by == null || empty($referral_by)) {
            $referral_by = 1257589132;
        }

        DB::beginTransaction();

        $id = $request->id;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        try {
            $dateTime = Carbon::now();
            $timestamp = $dateTime->timestamp;

            $user = User::where('telegram_id', $id)->first();




            if ($user) {
                // dd($user);

                $user_investment = InvestmentHistory::where('user_id', $user->id)->where('status', 2)->sum('amount');


                $totalPower = $user_investment / 10;

                if ($totalPower == 0) {
                    $totalPower = 1;
                } else {
                    $totalPower = $totalPower;
                }

                // dd($totalPower);

                $this->claimDaily($user);
                $user->setAttribute('totalPower', $totalPower);
            } else {

                $user = User::firstOrCreate(
                    ['telegram_id' => $id], // Condition to find the existing record
                    [
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'referral_by' => $referral_by,
                        'last_claim_timestamp' => $timestamp,
                    ] // Attributes to set if creating a new record
                );

                $investmentHistory = InvestmentHistory::create([
                    'user_id' => $user->id,
                    'amount' => 10,
                    'address' => null,
                    'invest_at' => $timestamp,
                    'status' => 2
                ]);
            }
            DB::commit();


            return response()->json([
                'user' => $user,

            ], 200);
        } catch (\Exception $e) {
            // Optionally handle the exception
            DB::rollBack();
            return response()->json(['register' => 'Register failed', 'message' => $e->getMessage()], 500);
        }
    }



    public function claimDailyAmount(Request $request)
    {
        // dd($request->amount);


        $user = User::where('id', $request->user_id)->first();
        // dd($request->user_id);
        $data = $this->claimDaily($user);
        // dd($data->claimable_amt);
        if ($data->claimable_amt <= 1) {


            return response()->json([
                'message' => 'Insufficient balance',

            ], 200);
        }


        $dateTime = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());
        $timestamp = $dateTime->timestamp;


        ClaimHistory::create([
            'telegram_id' => $user->telegram_id,
            'user_id' => $user->id,
            'amount' => $data->claimable_amt,
            'last_claim_timestamp' => $timestamp,
        ]);
        $TransactionHistory =  TransactionHistory::create([
            'user_id' => $user->id,
            'amount' => $data->claimable_amt,
            'type' => 0
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
        // dd($$request->all());
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

        if ($request->amount < 100) {
            return response()->json([
                'message' => 'Minimum Amount 100 Trx.'

            ], 200);
        }

        try {

            $investmentHistory = InvestmentHistory::create([
                'user_id' => $request->input('user_id'),
                'amount' => $request->input('amount'),
                'address' => $request->input('address'),
                'status' => 1,
                'invest_at' => $timestamp,
            ]);





            DB::commit();
            return response()->json([
                'message' => 'Your transaction will get automatically confirmed within 10 minutes.',
                'investment_history' => $investmentHistory
            ], 200);
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

        $addresses = Address::whereNull('user_id')->first();
        // dd($addresses);
        $status = 1;
        if ($addresses === null) {
            $status = 2;
            $config = Config::first();
            $address = $config->admin_wallet_address;
        } else {
            $address = $addresses->address;
        }

        $daily_Roi = config::first();
        $daily_profit = $daily_Roi->daily_roi;
        $rent_period = 30;
        $total_profit = $request->amount * $daily_profit * $rent_period / 100;
        $dailyProfit = $total_profit / $rent_period;
        $mining_power = $request->amount / 10;


        if ($status == 1) {
            $address = Address::find($addresses->id);
            $address->user_id = $request->user_id;
            $address->amount = $request->amount;
            $address->save();
            $address = $address->address;
        } else {
            $address = $address;
        }
        // dd($address);
        return response()->json(
            [
                'paymentAddress' => $address,
                'miningPower' => $mining_power,
                'rentPeriod'  => $rent_period,
                'Total_totalProfit'  => $total_profit,
                'dailyProfit'  => $dailyProfit,
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

        $Id = $request->user_id;
        $user_data = User::where('id', $Id)->first();
        $userId = $user_data->telegram_id;

        $level1Users = User::where('referral_by', $userId)->pluck('telegram_id');
        //dd($level1Users->toArray());
        $level1count = $level1Users->count();
        $level2Users = User::whereIn('referral_by', $level1Users)->pluck('telegram_id');
        // dd($level2Users->toArray());
        $level2count = $level2Users->count();
        $level3Users = User::whereIn('referral_by', $level2Users)->pluck('telegram_id');
        // dd($level3Users->toArray());
        $level3count = $level3Users->count();
        $downlineUsers = $level1Users->merge($level2Users)->merge($level3Users);


        // dd($downlineUsers->toArray());
        $idss = User::whereIn('telegram_id', $downlineUsers)->pluck('id');


        $results = TransactionHistory::with('userBy')
            ->select('by', 'level', DB::raw('SUM(amount) as total_profit'))
            ->where('to', $user_data->id)
            ->whereIn('by', $idss)
            ->where('type', 2)
            ->groupBy('by', 'level')
            ->get();

        $total_referral = $level1count + $level2count + $level3count;
        // dd($results->toArray());
        return response()->json(
            [
                'transactions' => $results,
                'level1count' => $level1count,
                'level2count' => $level2count,
                'level3count' => $level3count,
                'total_referral' => $total_referral


            ],
            200
        );
    }





    private function claimDaily($user)
    {

        $id = $user->id;

        $currentDate = Carbon::now();
        $Config_detail = Config::first();
        $paid_daily_roi = $Config_detail->daily_roi;
        $lastClaim = $user->claimHistories()->latest()->first();

        $user_investment = InvestmentHistory::where('user_id', $id)->where('status', 2)->get();
        // dd($user_investment);
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

    public function user_task(Request $request)
    {

        // $task_deatils = Task::where('type', $request->type)->get();
        $user = User::where('telegram_id', $request->telegram_id)->first();

        $userId = $user->id;
        $type = $request->type;

        $task_deatils = Task::with(['userTasks' => function ($query) use ($userId, $type) {
            $query->where('user_id', $userId);
        }])->where('type', $type)->get();


        $userTotalDirect = User::where('referral_by', $request->telegram_id)->count();
        $Invite_first_friend = User::where('referral_by', $request->telegram_id)
            ->where('status', 2)->first();
        // dd($Invite_first_friend);
        return response()->json([

            'user_Total_Direct' => $userTotalDirect,
            'user' => $user,
            'task_deatils' => $task_deatils,
            'Invite_first_friend' => $Invite_first_friend
        ], 200);
    }

    public function task_claim(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'task_id'  => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = User::where('id', $request->user_id)->first();
        $task_deatils = Task::where('id', $request->task_id)->first();



        try {
            $user_task = UserTask::create([
                'user_id' => $request->user_id,
                'amount' => $task_deatils->amount,
                'task_id' => $request->task_id,
                'type' => $task_deatils->type,
            ]);
            $TransactionHistory =  TransactionHistory::create([
                'user_id' => $request->user_id,
                'amount' => $task_deatils->amount,
                'type' => $task_deatils->type,
                'task_id' => $request->task_id,
            ]);

            $user->wallet += $task_deatils->amount;
            $user->save();


            return response()->json([
                'message' => 'Task claim successfully.',
                'user_task' => $user_task
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error user_task: ' . $e->getMessage()]);
        }
    }

    public function wallet_histroy(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        try {

            $user = User::where('id', $request->user_id)->first();
            $TransactionHistory = TransactionHistory::where('user_id', $request->user_id)->get();

            // dd($TransactionHistory);

            return response()->json([
                'TransactionHistory' => $TransactionHistory,
                'user_details' => $user,

            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to wallet_history'], 500);
        }
    }

    public function withdrow(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'address' => 'required',
            'amount' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $user = User::where('id', $request->user_id)->first();
            if ($request->amount  < 20) {

                return response()->json([
                    'message' => 'Amount must be at least 20.',

                ], 200);
            }

            if ($request->amount <= $user->wallet) {
                $Withdraw =  Withdraw::create([
                    'user_id' => $request->user_id,
                    'amount' => $request->amount,
                    'address' => $request->address,
                ]);

                $user->wallet -= $request->amount;
                $user->save();

                return response()->json([
                    'message' => 'Withdrawal request sent successfully.',
                    'Withdraw' => $Withdraw,
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Insufficient balance.',
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error Withdrow: ' . $e->getMessage()]);
        }
    }


    public function LinkVerify()
    {
        $LinkVerify = LinkVerify::get();
        // dd($LinkVerify);
        $config = config::first();
        $reward = $config->content_reward;
        return response()->json([
            'reward' => $reward,
            'LinkVerify' => $LinkVerify
        ], 200);
    }
    public function RequestLinkVerify(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'telegram_id' => 'required',
            'linkverify_id' => 'required',
            'link' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        // dd($request->all());
        $RequestLinkVerify =  ContentData::create([
            'telegram_id' => $request->telegram_id,
            'linkverify_id' => $request->linkverify_id,
            'link' => $request->link,
        ]);



        return response()->json([
            'message' => 'Your provided link is under review. A reward will be sent to your wallet based on eligibility.',
            'R_LinkVerify' => $RequestLinkVerify
        ], 200);
    }
}
