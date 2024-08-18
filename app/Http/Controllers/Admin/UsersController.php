<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Contact_data;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\InvestmentHistory;
use App\Models\TransactionHistory;
use App\Models\Level;
use App\Models\Withdraw;
use App\Models\Address;
use App\Models\Content_data;
use Carbon\Carbon;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();


        return view('admin.user.index', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     */


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // public function indianTimeZon($utcTimestamp)
    // {
    //     $istTimestamp = Carbon::createFromFormat('Y-m-d H:i:s', $utcTimestamp, 'UTC')
    //         ->setTimezone('Asia/Kolkata')
    //         ->format('Y-m-d H:i:s');

    //     return $istTimestamp;
    // }

    public function  investment_request(Request $request)
    {

        $status = $request->get('status', 1); // Defaults to 1 if status is not set
        $investment = InvestmentHistory::with('user')
            ->where('status', $status)
            ->get();
        // dd($investment);
        return view('admin.user.investment_request', compact('investment'));
    }

    public function  contact(Request $request)
    {

        // $contect = Contact_data::where('status', 1)->get();
        $status = $request->get('status', 1);
        // dd($request->all()); // Defaults to 1 if status is not set
        $contect = Contact_data::with('user', 'linkVerify')
            ->where('status', $status)
            ->get();

        // dd($contect);


        return view('admin.user.contact', compact('contect'));
    }
    public function updatecontacttStatus($id)
    {
        // dd($id); // For debugging purposes
        $request_accept = Contact_data::findOrFail($id);

        // Check if the status is already 'completed'
        $request_accept->status = 2;
        $request_accept->save();

        return redirect()->back()->with('success', 'Contact_data accept successfully!');
    }
    public function contactrejectStatus($id)
    {
        // dd($id); // For debugging purposes
        $rejectStatus = Contact_data::findOrFail($id);

        $rejectStatus->status = 0;
        $rejectStatus->save();


        return redirect()->back()->with('success', 'Contact_data Rejected successfully!');
    }

    public function updateInvestmentStatus($id)
    {
        // dd($id); // For debugging purposes
        $request_accept = InvestmentHistory::findOrFail($id);
        // dd($request_accept);
        $user_id = $request_accept->user_id;
        $user = User::findOrFail($user_id);
        $address = Address::where('address', $request_accept->address)->first();
        if ($address) {
            $address->user_id = null;
            $address->amount = null;
            $address->save();
        }


        $levels = Level::all();
        // dd($levels);
        $currentUser = $user;
        Log::info('Initial user data:', ['currentUser' => $currentUser->toArray()]);

        foreach ($levels as $level) {
            // dd($levels);
            if ($currentUser && $currentUser->referral_by) {
                $referrer = User::where('telegram_id', $currentUser->referral_by)->first();
                // dd($referrer);
                if (!$referrer) {
                    Log::warning('Referrer not found', ['referral_by' => $currentUser->referral_by]);
                    break;
                }
                echo 'level', $level->level;
                $bonusAmount = $request_accept->amount * $level->level_p / 100;
                echo 'bonusAmount', $bonusAmount;
                Log::warning('bonusAmount', ['bonusAmount' => $bonusAmount]);
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



        $user->status = 2;
        $request_accept->status = 2;
        $request_accept->save();
        $user->save();

        return redirect()->back()->with('success', 'Investment_request accept successfully!');
    }

    public function investrejectStatus($id)
    {
        // dd($id); // For debugging purposes
        $rejectStatus = InvestmentHistory::findOrFail($id);
        $address = Address::where('address', $rejectStatus->address)->first();
        if ($address) {
            $address->user_id = null;
            $address->amount = null;
            $address->save();
        }
        $rejectStatus->status = 0;
        $rejectStatus->save();


        return redirect()->back()->with('success', 'Investment_request Rejected successfully!');
    }
    public function withdraw_request(Request $request)
    {

        // Defaults to 1 if status is not set
        $Withdraw = TransactionHistory::with('user')
            ->where('type', 3)
            ->get();
        // $Withdraw = Withdraw::with('user')->get();
        // dd($Withdraw);
        return view('admin.user.withdraw_request', compact('Withdraw'));
    }
    public function updateStatus($id)
    {
        // dd($id); // For debugging purposes
        $request_accept = TransactionHistory::findOrFail($id);

        // Check if the status is already 'completed'
        $request_accept->status = 2;
        $request_accept->save();

        return redirect()->back()->with('success', 'withdraw_request accept successfully!');
    }

    public function rejectStatus($id)
    {
        // dd($id); // For debugging purposes
        $rejectStatus = TransactionHistory::findOrFail($id);

        $user_id = $rejectStatus->user_id;
        // Check if the status is already 'completed'
        $users = User::findOrFail($user_id);

        $users->wallet += $rejectStatus->amount;
        $rejectStatus->status = 0;
        // dd($withdraw);
        $rejectStatus->save();
        $users->save();

        return redirect()->back()->with('success', 'withdraw_request Rejected successfully!');
    }

    public function user_investment($id)
    {
        $investment = InvestmentHistory::with('user')->where('user_id', $id)->get();
        // dd($investment);
        return view('admin.user.user_investment', compact('investment'));
    }
}
