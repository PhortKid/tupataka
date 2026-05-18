<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PettyCashReceived;
use App\Models\PettyCashSource;

class PettyCashReceivedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pettyCashReceived = PettyCashReceived::where('status', '1')->get();
        $sources = PettyCashSource::where('status', '1')->get();
    
        return view('dashboard.pettycash_received.index', compact('pettyCashReceived','sources'));
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
            'date_received' => 'required|date',
            'cash_source_id' => 'required|exists:petty_cash_source,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string',
        ]);
        */

        $petty = new PettyCashReceived;
        $petty->date_received = $request->date_received;
        $petty->cash_source_id = $request->cash_source_id;
        $petty->amount = $request->amount;
        $petty->description = $request->description;
        $petty->created_by = auth()->id();
        $petty->updated_by = auth()->id();
        $petty->save();

        return redirect()->back()->with('success', 'Petty Cash Received Created');
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
            'date_received' => 'required|date',
            'cash_source_id' => 'required|exists:petty_cash_source,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string',
        ]);
        */

        $petty = PettyCashReceived::find($id);
        $petty->date_received = $request->date_received;
        $petty->cash_source_id = $request->cash_source_id;
        $petty->amount = $request->amount;
        $petty->description = $request->description;
        $petty->updated_by = auth()->id();
        $petty->save();

        return redirect()->back()->with('success', 'Petty Cash Received Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $petty = PettyCashReceived::find($id);
        $petty->status = '0';
        $petty->updated_by = auth()->id();
        $petty->save();

        return redirect()->back()->with('success', 'Petty Cash Received Deleted');
    }
}
