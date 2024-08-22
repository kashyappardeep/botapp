<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Config;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Config = Config::all();
        // dd($Config);
        return view('admin.config.index', compact('Config'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.config.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'daily_roi' => 'required',
                'admin_wallet_address' => 'required',
                'level_of_referral' => 'required',
                'task_amount' => 'required',
                'gateway_key' => 'nullable|string',
                'content_reward' => 'required',
                'min_withdrawal' => 'required',
                'min_investment' => 'required',

            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $Config = Config::create([
                'daily_roi' => $request->daily_roi,
                'admin_wallet_address' => $request->admin_wallet_address,
                'level_of_referral' => $request->level_of_referral,
                'task_amount' => $request->task_amount,
                'gateway_key' => $request->gateway_key,
                'content_reward' => $request->content_reward,
                'min_withdrawal' => $request->min_withdrawal,
                'min_investment' => $request->min_investment,
            ]);
            // dd($Config);
            return redirect()->route('Config.index')->with('success', 'Config created successfully!');
        } catch (ValidationException $error) {

            return redirect()->back()->withErrors($error->errors())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Config = Config::where('id', $id)->first();
        // dd($Config);
        return view('admin.config.edit', compact('Config'));
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
        $config = Config::findOrFail($id);

        // Update the config with the new values
        $config->daily_roi = $request->daily_roi;
        $config->admin_wallet_address = $request->admin_wallet_address;
        $config->level_of_referral = $request->level_of_referral;
        $config->task_amount = $request->task_amount;
        $config->gateway_key = $request->gateway_key;
        $config->content_reward = $request->content_reward;
        $config->min_withdrawal = $request->min_withdrawal;
        $config->min_investment = $request->min_investment;

        // Save the changes to the database
        $config->save();
        return redirect()->route('Config.index')->with('success', 'Config updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = Config::findOrFail($id); // Replace 'ModelName' with your actual model class

        // Delete the record
        $record->delete();

        return redirect()->back()->with('success', 'Config Record deleted Successfully!');
    }
}
