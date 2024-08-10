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
        DB::beginTransaction();

        $id = $request->id;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        try {
            $dateTime = Carbon::now();
            $timestamp = $dateTime->timestamp;

            $user = User::where('telegram_id', $id)->first();




            if ($user) {

                $user_investment = InvestmentHistory::where('user_id', $user->id)->sum('amount');
                $total = $user_investment - 20;
                $MiningPower = $total / 10;
                if ($MiningPower == 0) {
                    $totalPower = 1;
                } else {
                    $totalPower = $MiningPower;
                }
                // dd($totalPower);

                $this->claimDaily($user);
            } else {

                $user = User::create([
                    'telegram_id' => $id,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'referral_by' => $request->referral_by,
                    'last_claim_timestamp' => $timestamp,
                ]);

                $investmentHistory = InvestmentHistory::create([
                    'user_id' => $user->id,
                    'amount' => 20,
                    'address' => null,
                    'invest_at' => $timestamp,
                ]);
            }
            DB::commit();
            $user->setAttribute('totalPower', $totalPower);

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
                    // echo 'TransactionHistory', $TransactionHistory;
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
            // dd($address);
            foreach ($address as $address) {
                if ($address->user_id !== null) {
                    $address->user_id = $request->input('user_id');
                    $address->amount = $request->input('amount');
                    $address->save();
                }
            }



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

        $transactions = TransactionHistory::with('userBy')->where('to', $request->user_id)->get();
        // dd($transactions);
        // Prepare an array to hold the formatted transaction data
        $formattedTransactions = $transactions;

        // Iterate over each transaction and format the data
        // foreach ($transactions as $transaction) {
        //     $formattedTransactions[] = [
        //         'to' => $transaction->to,
        //         'by' => $transaction->by,
        //         'amount' => $transaction->amount,
        //         'type' => $transaction->type,
        //         'created_at' => $transaction->created_at->format('Y-m-d H:i:s'),
        //         'updated_at' => $transaction->updated_at->format('Y-m-d H:i:s'),
        //     ];
        // }

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
}
