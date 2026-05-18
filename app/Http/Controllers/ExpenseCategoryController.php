<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
class ExpenseCategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $expense_categories=ExpenseCategory::where('status','1')->get();
        return view('dashboard.expense_category.index',compact('expense_categories'));
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

        
        $expense_category=new ExpenseCategory;
        $expense_category->name=$request->name;
        $expense_category->description=$request->description;
        $expense_category->save();
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

        
        $expense_category=ExpenseCategory::find($id);
        $expense_category->name=$request->name;
        $expense_category->description=$request->description;
        $expense_category->save();

        return redirect()->back()->with('success', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $expense_category=ExpenseCategory::find($id);
         $expense_category->status='0';
         $expense_category->save();

         return redirect()->back()->with('success', 'Deleted');
    }
}
