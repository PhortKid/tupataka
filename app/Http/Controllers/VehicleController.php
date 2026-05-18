<?php


namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('dashboard.vehicle.index', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'plate_number' => 'required|string',
            'type' => 'required|string',
            'capacity' => 'required|string',
            'availability_status' => 'required|string',
            
        ]);
        Vehicle::create($validated);
        return redirect()->back()->with('success', 'Vehicle added!');
    }

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('dashboard.vehicle.edit', compact('vehicle'));
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $validated = $request->validate([
            'plate_number' => 'required|string',
            'type' => 'required|string',
            'capacity' => 'required|string',
            'availability_status' => 'required|string',
            
        ]);
        $vehicle->update($validated);
        return redirect()->route('vehicle.index')->with('success', 'Vehicle updated!');
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();
        return redirect()->route('vehicle.index')->with('success', 'Vehicle deleted!');
    }
}