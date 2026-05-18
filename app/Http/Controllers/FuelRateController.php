<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuelRate;
class FuelRateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fuel_rates=FuelRate::where('status','1')->get();
        return view('dashboard.fuel_rate.index',compact('fuel_rates'));
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
        $fuel_rate=new FuelRate;
        $fuel_rate->type=$request->type;
        $fuel_rate->rate=$request->rate;
        $fuel_rate->save();
        return redirect()->back()->with('success', 'Created');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fuel_rate=FuelRate::find($id);
        $fuel_rate->type=$request->type;
        $fuel_rate->rate=$request->rate;
        $fuel_rate->save();

        return redirect()->back()->with('success', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fuel_rate=FuelRate::find($id);
        $fuel_rate->status='0';
        $fuel_rate->save();

        return redirect()->back()->with('success', 'Deleted');
    }
}
