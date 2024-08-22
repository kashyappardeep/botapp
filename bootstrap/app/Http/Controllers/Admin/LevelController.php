<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Level;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Level = Level::all();
        // dd($Config);
        return view('admin.level.index', compact('Level'));
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
        try {
            $validator = Validator::make($request->all(), [
                'level' => 'required',

            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $level = Level::create([
                'level' => $request->level,

            ]);
            dd($level);
            return redirect()->back()->with('success', 'Level created successfully!');
        } catch (ValidationException $error) {

            return redirect()->back()->withErrors($error->errors())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $level = Level::where('id', $id)->first();
        // dd($level);

        return view('admin.level.edit', compact('level'));
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
        $level = Level::findOrFail($id);

        // Update the config with the new values
        $level->level = $request->level;

        // Save the changes to the database
        $level->save();
        return redirect()->route('Level.index')->with('success', 'level updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
