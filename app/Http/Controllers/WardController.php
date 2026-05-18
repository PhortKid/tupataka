<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ward;

class WardController extends Controller
{
    public function index()
    {
        $wards = Ward::with(['district', 'region', 'weoStaff'])->where('status','1')->latest()->paginate(10);
        $districts = \App\Models\District::where('status','1')->get();
        $regions = \App\Models\Region::where('status','1')->get();
        $weoStaff = \App\Models\WeoStaff::all();
        return view('dashboard.ward_management.index', compact('wards', 'districts', 'regions', 'weoStaff'));
    }
    // Removed fetch() method for blade/controller only
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'district_id' => 'required|integer',
            'region_id' => 'required|integer',
            'weo_staff_id' => 'required|integer', 
        ]);
        Ward::create($validated);
        return redirect()->route('ward_management.index')->with('success', 'Ward created successfully');
    }
    public function update(Request $request, $id)
    {
        $ward = Ward::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'district_id' => 'required|integer',
            'region_id' => 'required|integer',
        ]);
        $ward->update($validated);
        return redirect()->route('ward_management.index')->with('success', 'Ward updated successfully');
    }

        
    public function getByDistrict($district_id)
    {
        $wards = \App\Models\Ward::where('district_id', $district_id)->where('status','1')->get(['id', 'name']);
        return response()->json($wards);
    }

    public function destroy($id)
    {
       // Ward::destroy($id);

         $ward= Ward::findOrFail($id);
         $ward->status='0';
         $ward->save();

        return redirect()->route('ward_management.index')->with('success', 'Ward deleted successfully');
    }
}
