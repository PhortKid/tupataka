<?php

namespace App\Http\Controllers;

use App\Models\BusinessActivity;
use Illuminate\Http\Request;

class BusinessActivityController extends Controller
{
    public function index()
    {
        $business_activities=BusinessActivity::all();
        return view('dashboard.business_activities.index',compact('business_activities'));
    }


    public function fetch(Request $request)
    {
        $activities = BusinessActivity::where('status', '1')->get();
        return response()->json($activities);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'payment_type' => 'nullable|string',
            'bill_amount' => 'nullable|numeric|min:0',
        ]);

        BusinessActivity::create($request->only(['name', 'description','payment_type','bill_amount']));

        return redirect()->back()->with('success', 'Activity added successfully!');
    }

    public function update(Request $request, $id)
    {
        $activity = BusinessActivity::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
             'payment_type' => 'nullable|string',
            'bill_amount' => 'required|numeric|min:0',
        ]);

        $activity->update($request->only(['name', 'description','payment_type','bill_amount']));

        return redirect()->back()->with('success', 'Activity updated successfully!');
    }

    public function destroy($id)
    {
        $activity = BusinessActivity::findOrFail($id);
        $activity->status='0';
        $activity->save();

        
       

        return redirect()->back()->with('success', 'Activity deleted successfully!');
    }
}
