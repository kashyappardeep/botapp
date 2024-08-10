<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Address;
use App\Models\LinkVerify;



class VerifyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = LinkVerify::get();
        return view('admin.verify.verify', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.verify.add');
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        // Use Validator facade for validation
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:255',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the LinkVerify entry in the database
        $data = LinkVerify::create([
            'description' => $request->description,  // Ensure 'description' is passed
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Verification added successfully!');
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
        $data = linkverify::where('id', $id)->first();

        return view('admin.verify.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = LinkVerify::findOrFail($id);

        // Update the config with the new values

        // $address->user_id = $request->user_id;
        $data->description = $request->description;
        // dd($data);


        // Save the changes to the database
        $data->save();
        return redirect()->route('verify.index')->with('success', 'Description Verify  updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = LinkVerify::find($id);

        // Check if the record exists
        if (!$data) {
            return redirect()->back()->with('error', 'Record not found!');
        }

        // Delete the record
        $data->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Description deleted successfully!');
    }
}
