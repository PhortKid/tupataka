<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseParent;
use App\Models\ExpenseChild;
use App\Models\ExpenseCategory;
use App\Models\User;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the expenses with form to add new one.
     */
    public function index()
    {
        // Lete parents pamoja na children, payee na created_by
        $expenses = ExpenseParent::with(['children.category', 'payee', 'creator'])
        ->orderBy('id','desc')
        ->get();


        // Lete categories na payees kwa ajili ya form ya ku-add
        $categories = ExpenseCategory::where('status', '1')->get();
        $payees     = User::all();
        

        return view('dashboard.expenses.index', compact('expenses','categories','payees'));
    }

    /**
     * Store a newly created expense (parent + children).
     */
    public function store(Request $request)
    {
        $request->validate([
            'expense_date'         => 'required|date',
            'payee_id'             => 'required|integer',
            'items.category.*'     => 'required|integer',
            'items.amount.*'       => 'required|numeric|min:0',
        ]);

        // Save parent
        $parent = ExpenseParent::create([
            'expense_date' => $request->expense_date,
            'payee_id'     => $request->payee_id,
            'voucher_no'   => 'VCH' . time(), // auto voucher number
            'created_by'   => auth()->id(),
            'active'       => '1',
        ]);

        // Save children
        if ($request->items && isset($request->items['category'])) {
            foreach ($request->items['category'] as $index => $categoryId) {
                ExpenseChild::create([
                    'expense_id'      => $parent->id,
                    'expense_name_id' => $categoryId,
                    'amount'          => $request->items['amount'][$index],
                    'description'     => $request->items['description'][$index] ?? null,
                ]);
            }
        }

        return redirect()->route('expenses.index')->with('success', 'Expense recorded successfully!');
    }
}
