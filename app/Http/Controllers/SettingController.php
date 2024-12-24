<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $settings = Setting::paginate(5);
        return view('settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'key' => 'required|unique:settings,key',
            'value' => 'required',
        ]);

        Setting::create([
            'key' => $request->input('key'),
            'value' => $request->input('value'),
        ]);
        return redirect()->route('settings.index')->with('success', 'Setting added successfully!');
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
    public function edit(Setting $setting)
    {
        //

        return view('settings.edit', compact('setting'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        //
        $request->validate([
            'value' => 'required',
        ]);

        $setting->update($request->only(['value']));
        return redirect()->route('settings.index')->with('success', 'Setting updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
