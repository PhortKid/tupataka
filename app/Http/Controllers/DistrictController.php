<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Region;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::with('region')->where('status','1')->latest()->paginate(10);
        $regions = Region::where('status','1')->get();
        return view('dashboard.district_management.index', compact('districts', 'regions'));
    }
    // Removed fetch() method since you want to use controller and blade only

    // API endpoint: Get districts by region
    public function getByRegion($region_id)
    {
        $districts = District::where('region_id', $region_id)->where('status','1')->get(['id', 'name']);
        return response()->json($districts);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'region_id' => 'required|integer',
        ]);
        District::create($validated);
        return redirect()->route('district_management.index')->with('success', 'District created successfully');
    }
    public function update(Request $request, $id)
    {
        $district = District::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'region_id' => 'required|integer',
        ]);
        $district->update($validated);
        return redirect()->route('district_management.index')->with('success', 'District updated successfully');
    }
    public function destroy($id)
    {
       // District::destroy($id);

         $district = District::findOrFail($id);
         $district->status='0';
         $district->save();

        return redirect()->route('district_management.index')->with('success', 'District deleted successfully');
    }
}
