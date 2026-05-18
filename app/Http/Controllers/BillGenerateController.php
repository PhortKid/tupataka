<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\VerifiedCustomer;
use Illuminate\Http\Request;

class BillGenerateController extends Controller
{
    /**
     * Show bills page with form
     */
    public function index()
    {
        //$customers = VerifiedCustomer::with('bills', 'businessActivity')->get();
         $customers = VerifiedCustomer::with('bills', 'businessActivity', 'payments')->get();
        return view('dashboard.bills.index', compact('customers'));
    }

    /**
     * Add individual bill (amount auto from business activity)
     */
    public function storeIndividual(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:verified_customer,id',
            'date' => 'required|date',
        ]);

        $customer = VerifiedCustomer::with('businessActivity')->findOrFail($request->customer_id);

        Bill::create([
            'customer_id' => $customer->id,
            'amount' => $customer->businessActivity->bill_amount, // auto amount
            'date' => $request->date,
        ]);

        return redirect()->back()->with('success', 'Bill added successfully for individual customer.');
    }

    /**
     * Add bulk bills (all verified customers)
     */
    public function storeBulk(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $customers = VerifiedCustomer::with('businessActivity')->get();

        foreach ($customers as $customer) {
            Bill::create([
                'customer_id' => $customer->id,
                'amount' => $customer->businessActivity->bill_amount, // auto amount
                'date' => $request->date,
            ]);
        }

        return redirect()->back()->with('success', 'Bulk bills added successfully for all verified customers.');
    }
}
