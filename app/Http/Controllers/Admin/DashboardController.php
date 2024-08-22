<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\InvestmentHistory;
use App\Models\TransactionHistory;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::get()->count();
        $inactive = User::where('status', 1)->get()->count();
        $active = User::where('status', 2)->get()->count();
        $total_invest = InvestmentHistory::where('status', 2)->where('type', 2)->sum('amount');
        $total_Withdrawal = TransactionHistory::where('status', 2)->where('type', 3)->sum('amount');
        // dd($user);

        return view('admin.dashboard', compact('user', 'inactive', 'active', 'total_invest', 'total_Withdrawal'));
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
}
