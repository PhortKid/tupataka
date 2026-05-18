<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeoStaff;

class WeoStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $staffs=WeoStaff::all();
       
        return view('dashboard.weo_staff_management.index',compact('staffs'));
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
        $validated = $request->validate([
            'firstname' => 'required|string',
            'middlename' => 'nullable|string',
            'lastname' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email',
        ]);
        $staff = \App\Models\WeoStaff::create($validated);
        return redirect()->route('weo_staff_management.index')->with('success', 'Staff created successfully');
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
        $staff = \App\Models\WeoStaff::findOrFail($id);
        return view('dashboard.weo_staff_management.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'firstname' => 'required|string',
            'middlename' => 'nullable|string',
            'lastname' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email',
        ]);
        $staff = \App\Models\WeoStaff::findOrFail($id);
        $staff->update($validated);
        return redirect()->route('weo_staff_management.index')->with('success', 'Staff updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $staff = \App\Models\WeoStaff::findOrFail($id);
        $staff->delete();
        return redirect()->route('weo_staff_management.index')->with('success', 'Staff deleted successfully');
    }
}
