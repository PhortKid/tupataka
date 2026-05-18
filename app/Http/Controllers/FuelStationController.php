<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuelStation;
class FuelStationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fuel_stations=FuelStation::where('status','1')->get();
        return view('dashboard.fuel_station.index',compact('fuel_stations'));
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
        $fuel_station=new FuelStation;
        $fuel_station->name=$request->name;
        $fuel_station->tin=$request->tin;
        $fuel_station->address=$request->address;
        $fuel_station->save();
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
        $fuel_station=FuelStation::find($id);
        $fuel_station->name=$request->name;
        $fuel_station->tin=$request->tin;
        $fuel_station->address=$request->address;
        $fuel_station->save();

        return redirect()->back()->with('success', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fuel_station=FuelStation::find($id);
        $fuel_station->status='0';
        $fuel_station->save();

        return redirect()->back()->with('success', 'Deleted');
    }
}
