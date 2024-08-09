<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Address;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $address = Address::get();
        // dd($address);
        // die;

        return view('admin.Address.user_address', compact('address'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.address.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Use Validator facade for validation
        $validator = Validator::make($request->all(), [
            'address' => 'required|string|max:255',

        ]);

        if ($validator->fails()) {
            // Redirect back with errors and input data
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the address entry in the database
        $address = Address::create([

            'address' => $request->address,
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Address created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user_address = Address::where('id', $id)->first();
        // dd($user_address);
        return view('admin.adress.edit', compact('user_address'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $address = Address::where('id', $id)->first();

        return view('admin.address.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $address = Address::findOrFail($id);

        // Update the config with the new values

        // $address->user_id = $request->user_id;
        $address->address = $request->address;
        // dd($address);


        // Save the changes to the database
        $address->save();
        return redirect()->route('address.index')->with('success', 'Address updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address->delete();

        return redirect()->back()->with('success', 'Address deleted successfully!');
    }
}
