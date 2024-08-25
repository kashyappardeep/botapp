<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DailyTaskUserlist;
use App\Models\TransactionHistory;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class TaskUserlist extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        $status = $request->get('status', 1);
        // dd($request->all()); // Defaults to 1 if status is not set
        $DailyTask = DailyTaskUserlist::with('daily_task', 'user')
            ->where('status', $status)
            ->get();
        // $DailyTask = DailyTaskUserlist::with('daily_task', 'user')->get();
        // dd($DailyTask);
        return view('admin/DailyTaskUserlist/index', compact('DailyTask'));
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
        $TaskUserlist = DailyTaskUserlist::with('user')->where('id', $id)->first();
        // dd($TaskUserlist);
        return view('admin/DailyTaskUserlist/edit', compact('TaskUserlist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $data = DailyTaskUserlist::findOrFail($id);

        $user = User::where('id', $data->user_id)->first();
        // dd($user);
        $TransactionHistory =  TransactionHistory::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'type' => 5,
            'status' => 2
        ]);
        $user->wallet += $request->amount;
        $data->status = 2;

        $user->save();
        $data->save();
        return redirect()->route('TaskUserlist.index')->with('success', 'Daily Tasks Accept successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = DailyTaskUserlist::findOrFail($id);


        $data->status = 3;
        // dd($data);


        // Save the changes to the database
        $data->save();
        return redirect()->route('TaskUserlist.index')->with('success', 'Daily Tasks Reject successfully');
    }

    // public function accept_TaskUserlist(Request $request, string $id)
    // {
    //     $data = DailyTaskUserlist::findOrFail($id);

    //     $user = User::where('id', $data->user_id)->first();
    //     // dd($user);
    //     $TransactionHistory =  TransactionHistory::create([
    //         'user_id' => $user->id,
    //         'amount' => $request->amount,
    //         'type' => 5,
    //         'status' => 2
    //     ]);
    //     $user->wallet += $request->amount;
    //     $data->status = 2;

    //     $user->save();
    //     $data->save();
    //     return redirect()->route('TaskUserlist.index')->with('success', 'Daily Tasks Accept successfully');
    // }
}
