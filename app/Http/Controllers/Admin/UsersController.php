<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact_data;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\investmenthistory;
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
        $investment = investmenthistory::with('user')->get();
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
        $withdraw = investmenthistory::findOrFail($id);

        // Check if the status is already 'completed'
        $withdraw->status = 2;
        $withdraw->save();

        return redirect()->back()->with('success', 'Investment_request accept successfully!');
    }

    public function investrejectStatus($id)
    {
        // dd($id); // For debugging purposes
        $withdraw = investmenthistory::findOrFail($id);

        $withdraw->status = 0;
        $withdraw->save();

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
        $withdraw = Withdraw::findOrFail($id);

        // Check if the status is already 'completed'
        $withdraw->status = 2;
        $withdraw->save();

        return redirect()->back()->with('success', 'withdraw_request accept successfully!');
    }

    public function rejectStatus($id)
    {
        // dd($id); // For debugging purposes
        $withdraw = Withdraw::findOrFail($id);

        // Check if the status is already 'completed'
        $withdraw->status = 0;
        // dd($withdraw);
        $withdraw->save();

        return redirect()->back()->with('success', 'withdraw_request Rejected successfully!');
    }

    public function user_investment($id)
    {
        $investment = investmenthistory::where('user_id', $id)->get();
        // dd($investment);
        return view('admin.user.user_investment', compact('investment'));
    }
}
