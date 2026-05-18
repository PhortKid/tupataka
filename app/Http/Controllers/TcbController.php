<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TcbTransaction;
use Illuminate\Support\Facades\Http;

class TcbController extends Controller
{
    /*
    public function callback(Request $request)
    {
       $data = $request->all();

     AzamTransaction::create([
            'raw_payload'      => json_encode($data),
        ]);

        \Log::info('tcb Callback Data:', $data);


       

        return response()->json(['status' => 'received'], 200);
    }*/
    
public function callback(Request $request)
{
    
   
    try {
        // Decode JSON safely (Laravel automatically decodes if headers ok)
        $data = $request->json()->all(); // USE json() instead of all()

        // Default to empty array if data missing
        $data = is_array($data) ? $data : [];

        // Extract fields safely
        $status      = $data['status'] ?? null;
        $statusDesc  = $data['statusDesc'] ?? null;
        $param       = $data['param'] ?? [];

        $transactionId   = $param['transaction_id'] ?? null;
        $reference       = $param['reference'] ?? null;
        $amount          = $param['amount'] ?? null;
        $currency        = $param['currency'] ?? null;
        $transactionDate = $param['transaction_date'] ?? null;
        $phone           = $param['phone'] ?? null;
        $description     = $param['description'] ?? null;
        $accountNo       = $param['account_no'] ?? null;
        $charge          = $param['charge'] ?? null;
        $balance         = $param['balance'] ?? null;

        // Save transaction (allow nulls)
        TcbTransaction::updateOrCreate(
            ['transaction_id' => $transactionId],
            [
                'raw_payload'       => json_encode($data),
                'status'            => $status,
                'status_desc'       => $statusDesc,
                'reference'         => $reference,
                'amount'            => $amount,
                'currency'          => $currency,
                'transaction_date'  => $transactionDate,
                'phone'             => $phone,
                'description'       => $description,
                'account_no'        => $accountNo,
                'charge'            => $charge,
                'balance'           => $balance,
            ]
        );

        return response()->json(['status' => 'received'], 200);

    } catch (\Exception $e) {
        \Log::error("TCB Callback ERROR: " . $e->getMessage());
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
    
   
        
    
     
}







public function index(Request $request)
{
    // Default both dates = today
    $start = $request->input('start_date', now()->format('Y-m-d'));
    $end   = $request->input('end_date', now()->format('Y-m-d'));

    $transactions = TcbTransaction::with('customer')
        ->whereDate('transaction_date', '>=', $start)
        ->whereDate('transaction_date', '<=', $end)
        ->orderBy('transaction_date', 'desc')
        ->get();

    return view('dashboard.transactions.index', compact('transactions', 'start', 'end'));
}

    
}
