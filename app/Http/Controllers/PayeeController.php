<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payee;
class PayeeController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $payees=Payee::where('status','1')->get();
        return view('dashboard.payee.index',compact('payees'));
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

        
        $payee=new Payee;
        $payee->name=$request->name;
        $payee->tin=$request->tin;
        $payee->email=$request->email;
        $payee->mobile=$request->mobile;
        $payee->save();
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

        
        $payee=Payee::find($id);
        $payee->name=$request->name;
        $payee->tin=$request->tin;
        $payee->email=$request->email;
        $payee->mobile=$request->mobile;
        $payee->save();

        return redirect()->back()->with('success', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $payee=Payee::find($id);
         $payee->status='0';
         $payee->save();

         return redirect()->back()->with('success', 'Deleted');
    }
}
