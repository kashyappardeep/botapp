<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Models\InvestmentHistory;
use App\Models\TransactionHistory;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Count total users
        $user = User::count();

        // Count inactive users
        $inactive = User::where('status', 1)->count();

        // Count active users
        $active = User::where('status', 2)->count();

        // Total investment amount
        $total_invest = InvestmentHistory::where('status', 2)
            ->where('type', 2)
            ->sum('amount');

        // Total withdrawal amount
        $total_Withdrawal = TransactionHistory::where('status', 2)
            ->where('type', 3)
            ->sum('amount');

        // Calculate time range for the past 24 hours
        $now = Carbon::now();
        $twentyFourHoursAgo = $now->copy()->subHours(24);

        // Sum of investments in the past 24 hours
        $twentyFourHoursinvest = InvestmentHistory::where('status', 2)
            ->where('type', 2)
            ->whereBetween('created_at', [$twentyFourHoursAgo, $now])
            ->sum('amount');

        // Sum of withdrawals in the past 24 hours
        $twentyFourHoursWithdrawal = TransactionHistory::where('status', 2)
            ->where('type', 3)
            ->whereBetween('created_at', [$twentyFourHoursAgo, $now])
            ->sum('amount');

        // Return the view with the data
        return view('admin.dashboard', compact('twentyFourHoursWithdrawal', 'twentyFourHoursinvest', 'user', 'inactive', 'active', 'total_invest', 'total_Withdrawal'));
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
