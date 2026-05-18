<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regions = Region::where('status','1')->get();
        return view('dashboard.region_management.index', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);
        Region::create($validated);
        return redirect()->route('region_management.index')->with('success', 'Region created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $region = Region::findOrFail($id);
        return view('dashboard.region_management.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    { 

        $region = Region::findOrFail($id);
       $validated = $request->validate([
        'name' => 'required|string',
        'description' => 'nullable|string',
    ]);
    $region->update($validated);
    return redirect()->route('region_management.index')->with('success', 'Region updated successfully');
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $region = Region::findOrFail($id);
        $region->status='0';
        $region->save();
        return redirect()->route('region_management.index')->with('success', 'Region deleted successfully');
    }
}
