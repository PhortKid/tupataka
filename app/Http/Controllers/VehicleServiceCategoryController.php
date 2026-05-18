<?php


namespace App\Http\Controllers;

use App\Models\VehicleServiceCategory;
use Illuminate\Http\Request;

class VehicleServiceCategoryController extends Controller
{
    public function index()
    {
        $categories = VehicleServiceCategory::all();
        return view('dashboard.vehicle_service_category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_name' => 'required|string',
            'description' => 'nullable|string',
            
        ]);
        VehicleServiceCategory::create($validated);
        return redirect()->back()->with('success', 'Service category added!');
    }

    public function edit($id)
    {
        $category = VehicleServiceCategory::findOrFail($id);
        return view('dashboard.vehicle_service_category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = VehicleServiceCategory::findOrFail($id);
        $validated = $request->validate([
            'service_name' => 'required|string',
            'description' => 'nullable|string',
           
        ]);
        $category->update($validated);
        return redirect()->route('vehicle_service_category.index')->with('success', 'Service category updated!');
    }

    public function destroy($id)
    {
        $category = VehicleServiceCategory::findOrFail($id);
        $category->delete();
        return redirect()->route('vehicle_service_category.index')->with('success', 'Service category deleted!');
    }
}