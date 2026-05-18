<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PettyCashSource;
class PettyCashSourceController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $pettycashsources=PettyCashSource::where('status','1')->get();
        return view('dashboard.pettycashsource.index',compact('pettycashsources'));
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

        
        $pettycashsource=new PettyCashSource;
        $pettycashsource->name=$request->name;
        $pettycashsource->description=$request->description;
        $pettycashsource->save();
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

        
        $pettycashsource=PettyCashSource::find($id);
        $pettycashsource->name=$request->name;
        $pettycashsource->description=$request->description;
        $pettycashsource->save();

        return redirect()->back()->with('success', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $pettycashsource=PettyCashSource::find($id);
         $pettycashsource->status='0';
         $pettycashsource->save();

         return redirect()->back()->with('success', 'Deleted');
    }
}
