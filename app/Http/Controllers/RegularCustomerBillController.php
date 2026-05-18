<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegularCustomerBill;

class RegularCustomerBillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer_bills=RegularCustomerBill::where('status','1')->get();
        return view('dashboard.regular_customer_bills_management.index',compact('customer_bills'));
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
    {/*
          $request->validate([
            'name'=>'required',
            'rate'=>'required|numeric'
          ]);*/

        
        $customer_bill=new RegularCustomerBill;
        $customer_bill->name=$request->name;
        $customer_bill->rate=$request->rate;
        $customer_bill->save();
        
         /*
        RegularCustomerBill::create(['name'=>$request->name,'rate'=>$request->rate]);
            */
        return redirect()->back()->with('success', 'Regular Customer Bill Created');
       
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
        $customer_bill=RegularCustomerBill::find($id);
        $customer_bill->name=$request->name;
        $customer_bill->rate=$request->rate;
        $customer_bill->save();

         return redirect()->back()->with('success', 'Updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $customer_bill=RegularCustomerBill::find($id);
         $customer_bill->status='0';
         $customer_bill->save();

         return redirect()->back()->with('success', 'Deleted');
    }
}
