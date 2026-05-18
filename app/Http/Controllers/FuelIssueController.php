<?php

namespace App\Http\Controllers;

use App\Models\FuelIssue;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class FuelIssueController extends Controller
{
    /**
     * Onyesha list ya fuel issues zote.
     */
    public function index()
    {
        $fuelIssues = FuelIssue::where('status','1')->with(['truck', 'creator'])->latest()->get();
        $trucks = Vehicle::where('status','1')->get();
        return view('dashboard.fuel_issues.index', compact('fuelIssues', 'trucks'));
    }

    /**
     * Hifadhi fuel issue mpya.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'issue_date' => 'required|date',
            'fuel_type'  => 'required|string|max:255',
            'truck_id'   => 'required|exists:vehicle,id',
            'quantity'   => 'required|numeric|min:0',
            'amount'     => 'required|numeric|min:0',
            'staff_id_request' => 'nullable|integer',
        ]);

        $validated['created_by'] = auth()->id();

        FuelIssue::create($validated);

        return redirect()->route('fuel_issues.index')
                         ->with('success', 'Fuel issue created successfully');
    }

    /**
     * Futa fuel issue.
     */
    public function destroy($id)
    {
        $fuelIssue = FuelIssue::findOrFail($id);
        $fuelIssue->deleted_by = auth()->id();
        $fuelIssue->status='0';
        $fuelIssue->save();

      

        return redirect()->route('fuel_issues.index')
                         ->with('success', 'Fuel issue deleted successfully');
    }
}
