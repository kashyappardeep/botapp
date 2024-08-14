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
                'gateway_key' => 'required',
                'content_reward' => 'required',

            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $Config = Config::create([
                'daily_roi' => $request->daily_roi,
                'admin_wallet_address' => $request->admin_wallet_address,
                'level_of_referral' => $request->level_of_referral,
                'gateway_key' => $request->gateway_key,
                'content_reward' => $request->content_reward,
            ]);
            // dd($Config);
            return redirect()->back()->with('success', 'Config created successfully!');
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
        $config->gateway_key = $request->gateway_key;
        $config->content_reward = $request->content_reward;

        // Save the changes to the database
        $config->save();
        return redirect()->route('Config.index')->with('success', 'Config updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
