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
use App\Models\Content_data;

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

    public function  investment_request()
    {
        $investment = InvestmentHistory::with('user')->get();
        // dd($investment);
        // die;

        return view('admin.user.investment_request', compact('investment'));
    }

    public function  contact()
    {
        $contect = Contact_data::get();
        // dd($contect);
        // die;


        return view('admin.user.contact', compact('contect'));
    }

    public function updateInvestmentStatus($id)
    {
        // dd($id); // For debugging purposes
        $request_accept = InvestmentHistory::findOrFail($id);

        $user_id = $request_accept->user_id;
        $user = User::findOrFail($user_id);

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
                $bonusAmount = $request_accept->amount * $level->level_p / 100;
                $referrer->wallet += $bonusAmount;
                $referrer->save();

                $TransactionHistory =  TransactionHistory::create([
                    'amount' => $bonusAmount,
                    'level' => $level->level,
                    'to' => $referrer->id,
                    'by' => $user->id,
                    'type' => "1"
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

        $rejectStatus->status = 0;
        $rejectStatus->save();


        return redirect()->back()->with('success', 'Investment_request Rejected successfully!');
    }







    public function withdraw_request()
    {
        $Withdraw = Withdraw::with('user')->get();
        // dd($Withdraw);
        return view('admin.user.withdraw_request', compact('Withdraw'));
    }
    public function updateStatus($id)
    {
        // dd($id); // For debugging purposes
        $request_accept = Withdraw::findOrFail($id);

        // Check if the status is already 'completed'
        $request_accept->status = 2;
        $request_accept->save();

        return redirect()->back()->with('success', 'withdraw_request accept successfully!');
    }

    public function rejectStatus($id)
    {
        // dd($id); // For debugging purposes
        $rejectStatus = Withdraw::findOrFail($id);

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
        $investment = InvestmentHistory::where('user_id', $id)->get();
        // dd($investment);
        return view('admin.user.user_investment', compact('investment'));
    }
}
