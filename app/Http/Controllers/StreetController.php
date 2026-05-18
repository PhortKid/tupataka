<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Street;

class StreetController extends Controller
{
    public function index()
    {
        $districts = \App\Models\District::where('status','1')->get();
        $regions = \App\Models\Region::where('status','1')->get();
        $wards = \App\Models\Ward::where('status','1')->get();
        $streets= \App\Models\Street::where('status','1')->latest()->paginate(10);
        return view('dashboard.street_management.index',compact('districts', 'regions','streets','wards'));
    }
    public function fetch()
    {
        return response()->json(Street::where('status','1')->get());
    }

     public function getByWard($ward_id)
    {
         $streets = \App\Models\Street::where('ward_id', $ward_id)->where('status','1')->get(['id', 'name']);
         return response()->json($streets);
        
    }

   
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
           // 'status' => 'required|in:active,inactive',
            'ward_id' => 'required|integer',
            'district_id' => 'required|integer',
            'region_id' => 'required|integer',
            
        ]);
        Street::create($validated);
        return redirect()->route('street_management.index')->with('success', 'Street added successfully');
    }
    public function update(Request $request, $id)
    {
        $street = Street::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
           // 'status' => 'required|in:active,inactive',
            'ward_id' => 'required|integer',
            'district_id' => 'required|integer',
            'region_id' => 'required|integer',
        ]);
        $street->update($validated);
        return redirect()->route('street_management.index')->with('success', 'Street updated successfully');
    }
    public function destroy($id)
    {
       // Street::destroy($id);

        $street = Street::findOrFail($id);
         $street->status='0';
         $street->save();
        return response()->json(['success' => true]);
    }
}
