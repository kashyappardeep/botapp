<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DailyTask;
use Illuminate\Support\Facades\Validator;

class DailyTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $DailyTask = DailyTask::get();
        // dd($DailyTask);
        return view('admin/dailytasks/index', compact('DailyTask'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/dailytasks/add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:255',
            'type' => 'required',
            'status' => 'required',
            'amount' => 'required',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the LinkVerify entry in the database
        $data = DailyTask::create([
            'description' => $request->description,
            'type' => $request->type,
            'status' => $request->status,
            'amount' => $request->amount
        ]);
        // dd($data);
        // Redirect back with success message
        return redirect()->route('DailyTasks.index')->with('success', 'Daily Task added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $DailyTask = DailyTask::where('id', $id)->first();
        // dd($DailyTask);
        return view('admin/dailytasks/edit', compact('DailyTask'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = DailyTask::findOrFail($id);

        // Update the config with the new values

        // $address->user_id = $request->user_id;
        $data->description = $request->description;
        $data->type = $request->type;
        $data->status = $request->status;
        $data->amount = $request->amount;
        // dd($data);


        // Save the changes to the database
        $data->save();
        return redirect()->route('DailyTasks.index')->with('success', 'Daily Tasks updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = DailyTask::findOrFail($id);


        $data->status = 2;
        // dd($data);


        // Save the changes to the database
        $data->save();
        return redirect()->route('DailyTasks.index')->with('success', 'Daily Tasks Stop successfully');
    }
}
