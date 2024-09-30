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
use App\Models\Level;
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

        $id = $request->id;
        $first_name = $request->first_name;
        $last_name = $request->last_name;

        try {
            $dateTime = Carbon::now();
            $timestamp = $dateTime->timestamp;

            $user = User::where('telegram_id', $id)->first();

            if ($user) {
                $user_investment = InvestmentHistory::where('user_id', $user->id)
                    ->where('status', 2)
                    ->sum('amount');

                // Check if user investment is numeric
                if (!is_numeric($user_investment)) {
                    return response()->json(['register' => 'Register failed', 'message' => 'User investment is not numeric'], 500);
                }

                $totalPower = $user_investment / 10;

                // Check if totalPower is numeric
                if (!is_numeric($totalPower)) {
                    return response()->json(['register' => 'Register failed', 'message' => 'Total power calculation failed'], 500);
                }

                $totalPower = $totalPower == 0 ? 1 : $totalPower;

                // Claim daily ROI
                $user = $this->claimDaily($user);
                $user->setAttribute('totalPower', $totalPower);
            } else {
                $referral_by = $request->referral_by;
                if ($referral_by == null || empty($referral_by)) {
                    $referral_by = 1257589132;
                }

                $sponsor_user = User::where('telegram_id', $referral_by)->first();

                if (empty($sponsor_user) || $sponsor_user == null) {
                    $referral_by = 1257589132;
                    $sponsor_user = User::where('telegram_id', $referral_by)->first();
                }

                DB::beginTransaction();

                // Create a new user if one does not exist
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

                // Create a new investment history record
                InvestmentHistory::create([
                    'user_id' => $user->id,
                    'amount' => 10,
                    'address' => null,
                    'invest_at' => $timestamp,
                    'status' => 2,
                    'type' => 1
                ]);

                // Create a new transaction history record
                TransactionHistory::create([
                    'amount' => 0,
                    'level' => 1,
                    'to' => $sponsor_user->id,
                    'by' => $user->id,
                    'type' => "2",
                    'status' => 2
                ]);

                DB::commit();
            }

            return response()->json([
                'user' => $user,
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['register' => 'Register failed', 'message' => $e->getMessage()], 500);
        }
    }

    private function claimDaily($user)
    {
        $id = $user->id;
        $currentDate = Carbon::now();
        $Config_detail = Config::first();

        $paid_daily_roi = $Config_detail->daily_roi;

        // Log the daily ROI value
        Log::info('Paid Daily ROI: ' . $paid_daily_roi);

        if (!is_numeric($paid_daily_roi)) {
            return response()->json(['register' => 'Register failed', 'message' => 'daily_roi is not numeric'], 500);
        }

        $lastClaim = $user->claimHistories()->latest()->first();
        $user_investment = InvestmentHistory::where('user_id', $id)->where('status', 2)->get();
        $user = User::find($id);

        $claim_amount = 0;
        $per_day_roi_rate = 0;

        foreach ($user_investment as $investment) {
            $investment_amount = $investment->amount;

            // Log the investment amount
            Log::info('Investment Amount: ' . $investment_amount);

            if (!is_numeric($investment_amount)) {
                return response()->json(['register' => 'Register failed', 'message' => 'investment amount is not numeric'], 500);
            }

            $lastClaimDate = $investment->invest_at > $lastClaim ? $investment->invest_at : $lastClaim->last_claim_timestamp;

            // Log the last claim date
            Log::info('Last Claim Date (Timestamp): ' . $lastClaimDate);

            if (!is_numeric($lastClaimDate)) {
                return response()->json(['register' => 'Register failed', 'message' => 'last claim date is not valid'], 500);
            }

            $old_date = Carbon::createFromTimestamp($lastClaimDate);
            $differenceInSeconds = $old_date->diffInSeconds($currentDate);

            // Log the difference in seconds
            Log::info('Difference in Seconds: ' . $differenceInSeconds);

            $one_day_roi = floatval($investment_amount) * floatval($paid_daily_roi) / 100;

            Log::info('One Day ROI: ' . $one_day_roi);

            $investment_claim_amount = number_format(($one_day_roi / 86400 * floatval($differenceInSeconds)), 8);

            Log::info("Investment Claim Amount: " . $investment_claim_amount);

            $claim_amount += floatval($investment_claim_amount);
            $per_day_roi_rate += floatval($one_day_roi);
        }

        // Log total values before further calculations
        Log::info("Total Claim Amount: " . $claim_amount);
        Log::info("Total Per Day ROI Rate: " . $per_day_roi_rate);

        if (!is_numeric($per_day_roi_rate)) {
            return response()->json(['register' => 'Register failed', 'message' => 'per_day_roi_rate is not numeric'], 500);
        }

        $per_10_milliseconds_rate = number_format($per_day_roi_rate / 86400, 8);

        Log::info("Per 10 Milliseconds Rate: " . $per_10_milliseconds_rate);

        $user->claimable_amt = floatval($claim_amount);
        $user->roi_rate = floatval($per_10_milliseconds_rate) == 0.00000000 ? 0.00000006 : floatval($per_10_milliseconds_rate);

        Log::info('Final Claimable Amount: ' . $user->claimable_amt);
        Log::info('Final ROI Rate: ' . $user->roi_rate);

        $user->save();

        return $user;
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
                'tx_hash' => $request->input('tx_hash'),
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
        $rent_period = 200;
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

        try {
            $user = User::where('id', $request->user_id)->first();
            $min_withdrawal = Config::first();
            // dd($min_withdrawal->min_withdrawal);
            if ($request->amount  < $min_withdrawal->min_withdrawal) {

                return response()->json([
                    'message' => 'Amount must be at least ' . $min_withdrawal->min_withdrawal . ' Trx',

                ], 200);
            }

            if ($user->status == 1) {
                return response()->json([
                    'message' => 'Boost your account to unlock your  withdrawal!'
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
        $contact_data = Contact_data::where('telegram_id', $request->telegram_id)
            ->latest('created_at')
            ->first();

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
            'LinkVerify' => $LinkVerify
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
