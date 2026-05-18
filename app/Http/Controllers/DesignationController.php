<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Designation;
class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $designations=Designation::where('status','1')->get();
        return view('dashboard.designation.index',compact('designations'));
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
        /*
          $request->validate([
            'name'=>'required',
            'description'=>'required'
          ]);*/

        
        $designation=new Designation;
        $designation->name=$request->name;
        $designation->description=$request->description;
        $designation->save();
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
         /*
          $request->validate([
            'name'=>'required',
            'description'=>'required'
          ]);*/

        
        $designation=Designation::find($id);
        $designation->name=$request->name;
        $designation->description=$request->description;
        $designation->save();

        return redirect()->back()->with('success', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $designation=Designation::find($id);
         $designation->status='0';
         $designation->save();

         return redirect()->back()->with('success', 'Deleted');
    }
}
