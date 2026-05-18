<?php

namespace App\Http\Controllers;

use App\Models\TruckService;
use App\Models\Vehicle;
use App\Models\VehicleServiceCategory;
use Illuminate\Http\Request;

class TruckServiceController extends Controller
{
    public function index()
    {
        $services = TruckService::where('status','1')->with(['truck', 'serviceCategory', 'creator'])->latest()->get();
        $trucks = Vehicle::where('status','1')->get();
        $categories = VehicleServiceCategory::where('status','1')->get();

        return view('dashboard.truck_services.index', compact('services', 'trucks', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_date' => 'required|date',
            'truck_id' => 'required|exists:vehicle,id',
            'service_category_id' => 'required|exists:vehicle_service_category,id',
            'next_service_reading' => 'nullable|integer',
            'service_cost' => 'required|numeric|min:0',
            'remarks' => 'nullable|string',
            'served_by' => 'nullable|exists:users,id',
        ]);

        $validated['created_by'] = auth()->id();

        TruckService::create($validated);

        return redirect()->route('truck_services.index')
                         ->with('success', 'Truck service recorded successfully');
    }

    public function destroy($id)
    {
        $service = TruckService::findOrFail($id);
        $service->updated_by = auth()->id();
        $service->status='0';
        $service->save();
     

        return redirect()->route('truck_services.index')
                         ->with('success', 'Truck service deleted successfully');
    }
}
