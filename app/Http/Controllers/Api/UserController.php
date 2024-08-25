<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\Config;
use App\Models\InvestmentHistory;
use App\Models\TransactionHistory;
use App\Models\LinkVerify;
use App\Models\Contact_data;

use App\Models\ClaimHistory;
use App\Models\Address;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\DailyTask;
use App\Models\DailyTaskUserlist;
use App\Models\UserTask;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required|max:255|unique:users',
            'last_name' => 'nullable|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'referral_by' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }


        // dd($request->all());

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

                $user =  $this->claimDaily($user);
                $user->setAttribute('totalPower', $totalPower);
            } else {

                $referral_by = $request->referral_by;
                if ($referral_by == null || empty($referral_by)) {
                    $referral_by = 1257589132;
                }

                $sponsor_user =    User::where('telegram_id', $referral_by)->first();

                if (empty($sponsor_user) || $sponsor_user == null) {
                    $referral_by = 1257589132;
                    $sponsor_user =    User::where('telegram_id', $referral_by)->first();
                }
                // dd($sponsor_user);
                DB::beginTransaction();
                $user = User::firstOrCreate(
                    ['telegram_id' => $id], // Condition to find the existing record
                    [
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'referral_by' => $referral_by,
                        'last_claim_timestamp' => $timestamp,
                        'claimable_amt' => 0.00000000,
                        'roi_rate' => 0.00000006,
                        'status' => 1
                    ] // Attributes to set if creating a new record
                );


                $investmentHistory = InvestmentHistory::create([
                    'user_id' => $user->id,
                    'amount' => 5,
                    'address' => null,
                    'invest_at' => $timestamp,
                    'status' => 2,
                    'type' => 1

                ]);
                $TransactionHistory =  TransactionHistory::create([
                    'amount' => 0,
                    'level' => 1,
                    'to' => $sponsor_user->id,
                    'by' => $user->id,
                    'type' => "2",
                    'status' => 2
                ]);
            }
            DB::commit();

            //  $user = User::where('telegram_id', $id)->first();
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
            'type' => 0,
            'status' => 2
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
            'tx_hash' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $address = Address::where('address', $request->address)->first();

        if ($address) {
            $address->user_id = $request->user_id;
            $address->amount = $request->amount;

            $address->save();
        }
        $dateTime = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());
        // Convert the datetime to a timestamp
        $timestamp = $dateTime->timestamp;

        DB::beginTransaction();
        $Config_data = Config::first();
        // dd($min_investment->min_investment);
        if ($request->amount < $Config_data->min_investment) {
            return response()->json([
                'message' => 'Minimum Amount ' . $Config_data->min_investment . ' Trx.'
            ], 200);
        }

        try {

            $investmentHistory = InvestmentHistory::create([
                'user_id' => $request->input('user_id'),
                'amount' => $request->input('amount'),
                'address' => $request->input('address'),
                'status' => 1,
                'type' => 2,
<<<<<<< HEAD
=======
                'tx_hash' => $request->input('tx_hash'),
>>>>>>> 9e6cd4e14bc9cf82a6cd2845d47a40224bd14bba
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
        // Log::info('testt');

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',


        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $addresses = Address::whereNull('user_id')->first();

        if ($addresses === null) {

            $config = Config::first();
            $address = $config->admin_wallet_address; // Assume this is a string
        } else {
            $address = $addresses->address; // This is a string as well
        }

        $daily_Roi = config::first();
        $daily_profit = $daily_Roi->daily_roi;
        $rent_period = 30;
        $total_profit = $request->amount * $daily_profit * $rent_period / 100;
        $dailyProfit = $total_profit / $rent_period;
        $mining_power = $request->amount / 10;



        // dd($address);
        return response()->json(
            [
                'paymentAddress' => $address,
                'miningPower' => $mining_power,
                'rentPeriod'  => $rent_period,
                'totalProfit'  => $total_profit,
                'dailyProfit'  => $dailyProfit,
                'price'  => $request->amount

            ],
            200
        );
    }

    public function transactions(Request $request)
    {
        // Log::info('apiii l');
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'type'  => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $Id = $request->user_id;
        $user_data = User::where('id', $Id)->first();
        $telegram_id = $user_data->telegram_id;

        $users1 = User::where('referral_by', $telegram_id)->get(['id', 'telegram_id']);
        $telegramIds1 = $users1->pluck('telegram_id');
        $ids1 = $users1->pluck('id')->toArray();

        //  dd($telegramIds1);



        $users2 = User::wherein('referral_by', $telegramIds1)->get(['id', 'telegram_id']);
        $telegramIds2 = $users2->pluck('telegram_id');
        $ids2 = $users2->pluck('id')->toArray();

        $users3 = User::wherein('referral_by', $telegramIds2)->get(['id', 'telegram_id']);
        $telegramIds3 = $users3->pluck('telegram_id');
        $ids3 = $users3->pluck('id')->toArray();


        $level1count = $telegramIds1->count();
        $level2count = $telegramIds2->count();
        $level3count = $telegramIds3->count();

        $idss =  array_merge($ids1, $ids2, $ids3);
        // dd($idss->toArray());
        if ($idss) {
            // TransactionHistory::select()
            $unionQuery = implode(' UNION ALL ', array_map(function ($id) {
                return "SELECT $id as `by`";
            }, $idss));

            // Full SQL query
            $query = "
            SELECT u.by, IFNULL(SUM(t.amount), 0) AS total_profit, users.first_name ,users.status
            FROM (
                $unionQuery
            ) as u
            LEFT JOIN transactions_history t 
            ON u.by = t.by 
            AND t.to = " . $request->user_id . " 
            AND t.type = 2 
            LEFT JOIN users 
            ON u.by = users.id 
            GROUP BY u.by, users.first_name,users.status;
        ";


            // Execute the query
            $results = DB::select($query);



            foreach ($results as $key => $value) {
                // echo "<pre>";
                // print_r($ids1);
                // die;
                if (in_array($value->by,  $ids1,  $strict = false)) {

                    $level = 1;
                } elseif (in_array($value->by,  $ids2,  $strict = false)) {
                    $level = 2;
                } else {
                    $level = 3;
                }

                $value->level =  $level;
            }



            $total_referral = $level1count + $level2count + $level3count;
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
        } else {
            return response()->json(
                [
                    'transactions' => null,
                    'level1count' => 0,
                    'level2count' => 0,
                    'level3count' => 0,
                    'total_referral' => 0


                ],
                200
            );
        }
        // dd($results->toArray());

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
        $user = User::find($id);

        $claim_amount = 0;
        $per_day_roi_rate = 0;

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
            Log::info('per day roi');
            Log::info($one_day_roi);
            $investment_claim_amount = number_format(($one_day_roi / 86400 * $differenceInSeconds), 8);

            Log::info("differenceInSeconds");
            Log::info($differenceInSeconds);
            $claim_amount += $investment_claim_amount;
            Log::info("claim_amount");
            Log::info($claim_amount);
            $per_day_roi_rate += $one_day_roi;
        }


        $per_10_milliseconds_rate = number_format($per_day_roi_rate / 86400, 8);

        Log::info("claim_amounttt");
        Log::info($claim_amount);

        $user->claimable_amt = $claim_amount;
        Log::info('perrr day roi');
        Log::info($claim_amount);
        if ($per_10_milliseconds_rate == 0.00000000) {
            $per_10_milliseconds_rate = 0.00000006;
        }
        $user->roi_rate = $per_10_milliseconds_rate;



        // Log::info(' per_10_milliseconds_rate roi');
        // Log::info($per_10_milliseconds_rate);

        $user->save();
        // $user = User::find($id);
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
                'status' => 2
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
        // Log::info('wwwwww');
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        try {

            $user = User::where('id', $request->user_id)->first();
            $TransactionHistory = TransactionHistory::where('user_id', $request->user_id)->get();
            // dd($Withdraw_hist);

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
        $user = User::where('id', $request->user_id)->first();
        // dd($user->status);
        // if ($user->status == 1) {
        //     return response()->json([
        //         'message' => 'Boost your account to unlock your  withdrawal!'
        //     ], 200);
        // }
        try {
<<<<<<< HEAD
            $user = User::where('id', $request->user_id)->first();
            $min_withdrawal = Config::first();
            // dd($min_withdrawal->min_withdrawal);
=======
            $min_withdrawal = Config::first();

>>>>>>> 9e6cd4e14bc9cf82a6cd2845d47a40224bd14bba
            if ($request->amount  < $min_withdrawal->min_withdrawal) {

                return response()->json([
                    'message' => 'Amount must be at least ' . $min_withdrawal->min_withdrawal . ' Trx',

                ], 200);
            }

            if ($request->amount % 10 !== 0) {

                return response()->json([
                    'message' => 'The amount must be a multiple of 10.',

                ], 200);
            }




            if ($request->amount <= $user->wallet) {
                $Withdraw =  TransactionHistory::create([
                    'user_id' => $request->user_id,
                    'amount' => $request->amount,
                    'address' => $request->address,
                    'type' => 3,



                ]);


                $user->wallet -= $request->amount;
                $user->save();

                return response()->json([
                    'message' => 'Your withdrawal will be processed within 24 hours',
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
        $LinkVerify = LinkVerify::where('type', 1)->where('status', 2)->get();
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
            'telegram_id' => 'required|exists:users,telegram_id',
            'linkverify_id' => 'required',
            'link' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
<<<<<<< HEAD
        $contact_data = Contact_data::where('telegram_id', $request->telegram_id)
            ->latest('created_at')
            ->first();
=======
        // $contact_data = Contact_data::where('telegram_id', $request->telegram_id)
        //     ->latest('created_at')
        //     ->first();
        $contact_data = Contact_data::where('telegram_id', $request->telegram_id)
            ->first();

        // Check if there was a previous entry and if it was within the last 24 hours
        // if ($contact_data && $contact_data->created_at->diffInHours(Carbon::now()) < 24) {
        if ($contact_data) {
            return response()->json([
                'message' => 'You already submitted this task, please wait for the next task.',
            ], 200);
        }
        // dd($request->all());
        $user = User::where('telegram_id', $request->telegram_id)->first();
        if ($user) {
            $RequestLinkVerify =  Contact_data::create([
                'telegram_id' => $request->telegram_id,
                'linkverify_id' => $request->linkverify_id,
                'link' => $request->link,
                'type' => 1
            ]);



            return response()->json([
                'message' => 'Your provided link is under review. A reward will be sent to your wallet based on eligibility.',
                'R_LinkVerify' => $RequestLinkVerify
            ], 200);
        } else {
            return response()->json([
                'message' => 'click (My invite link or my ID 123467890 is indicated under the video)',

            ], 200);
        }
    }
    public function showusertaskrecord(Request $request)

    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        try {
            $TaskUserlist = DailyTaskUserlist::where('user_id', $request->user_id)->get();
            // dd($TransactionHistory);

            return response()->json([
                'TaskUserlist' => $TaskUserlist,

            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to DailyTaskUserlist'], 500);
        }
    }


    public function Bost_history(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        try {
            $user = User::where('id', $request->user_id)->first();
            $bost = InvestmentHistory::where('user_id', $request->user_id)
                ->where('type', 2)->get();

            // dd($TransactionHistory);

            return response()->json([
                'bost' => $bost,
                'user_details' => $user,

            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to wallet_history'], 500);
        }
    }

    public function DailyTask()
    {
        $DailyTask = DailyTask::where('status', 1)->first();
        // dd($LinkVerify);


        return response()->json([
            'DailyTask' => $DailyTask
        ], 200);
    }
    public function DailyTaskUserlist(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'link' => 'required',
            'amount' => 'required',
            'type' => 'required',
            'daily_task_id' => 'required|exists:daily_tasks,id'


        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $user_data = DailyTaskUserlist::where('daily_task_id', $request->daily_task_id)
            ->where('user_id', $request->user_id)->first();
        if ($user_data) {
            return response()->json([
                'message' => 'You already submitted this daily task, please wait for the next task.',
            ], 200);
        }


        $TaskUserlist =  DailyTaskUserlist::create([
            'user_id' => $request->user_id,
            'daily_task_id' => $request->daily_task_id,
            'link' => $request->link,
            'type' => $request->type,
            'amount' => $request->amount,
        ]);
>>>>>>> 9e6cd4e14bc9cf82a6cd2845d47a40224bd14bba

        // Check if there was a previous entry and if it was within the last 24 hours
        if ($contact_data && $contact_data->created_at->diffInHours(Carbon::now()) < 24) {
            return response()->json([
                'message' => 'You can submit one link per day ',
            ], 200);
        }
        // dd($request->all());
        $user = User::where('telegram_id', $request->telegram_id)->first();
        if ($user) {
            $RequestLinkVerify =  Contact_data::create([
                'telegram_id' => $request->telegram_id,
                'linkverify_id' => $request->linkverify_id,
                'link' => $request->link,
                'type' => 1
            ]);



            return response()->json([
                'message' => 'Your provided link is under review. A reward will be sent to your wallet based on eligibility.',
                'R_LinkVerify' => $RequestLinkVerify
            ], 200);
        } else {
            return response()->json([
                'message' => 'click (My invite link or my ID 123467890 is indicated under the video)',

            ], 200);
        }
    }
    public function earn_by_facebook()
    {
        $LinkVerify = LinkVerify::where('type', 2)->where('status', 2)->get();
        // dd($LinkVerify);


        return response()->json([
<<<<<<< HEAD
            'LinkVerify' => $LinkVerify
=======
            'message' => 'Your provided link is under review. A reward will be sent to your wallet based on eligibility.',
            'TaskUserlist' => $TaskUserlist
>>>>>>> 9e6cd4e14bc9cf82a6cd2845d47a40224bd14bba
        ], 200);
    }

    public function RequestFbPopup(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'telegram_id' => 'required|exists:users,telegram_id',
            'link' => 'required',


        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $contact_data = Contact_data::where('telegram_id', $request->telegram_id)
            ->latest('created_at')
            ->first();

        // Check if there was a previous entry and if it was within the last 24 hours
        if ($contact_data && $contact_data->created_at->diffInHours(Carbon::now()) < 24) {
            return response()->json([
                'message' => 'You can submit one link per day',
            ], 200);
        }
        // dd($contact_data);
        if ($contact_data) {
            return response()->json([
                'message' => '',

            ], 200);
        }
        // dd($request->all());
        $user = User::where('telegram_id', $request->telegram_id)->first();
        if ($user) {
            $RequestLinkVerify =  Contact_data::create([
                'telegram_id' => $request->telegram_id,
                'link' => $request->link,
                'type' => 2
            ]);
            return response()->json([
                'message' => 'Your provided link is under review. A reward will be sent to your wallet based on eligibility.',
                'R_LinkVerify' => $RequestLinkVerify
            ], 200);
        } else {
            return response()->json([
                'message' => 'click (My invite link or my ID 123467890 is indicated under the video)',

            ], 200);
        }
    }
    public function Bost_history(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        try {
            $user = User::where('id', $request->user_id)->first();
            $bost = InvestmentHistory::where('user_id', $request->user_id)
                ->where('type', 2)->get();

            // dd($TransactionHistory);

            return response()->json([
                'bost' => $bost,
                'user_details' => $user,

            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to wallet_history'], 500);
        }
    }
}
