<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AzamTransaction;
use Illuminate\Support\Facades\Http;

class AzamPayController extends Controller
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
        // Read payload
        $data = $request->all();

        // Save raw callback
        AzamTransaction::create([
            'raw_payload' => json_encode($data),
        ]);

        // Log callback for debugging
        \Log::channel('tcb')->info('TCB Callback Received:', $data);

        // Extract important fields safely
        $status       = $data['status'] ?? null;
        $statusDesc   = $data['statusDesc'] ?? null;
        $param        = $data['param'] ?? [];

        $transactionId  = $param['transaction_id'] ?? null;
        $reference      = $param['reference'] ?? null;
        $amount         = $param['amount'] ?? null;
        $currency       = $param['currency'] ?? null;
        $transactionDate= $param['transaction_date'] ?? null;
        $phone          = $param['phone'] ?? null;
        $description    = $param['description'] ?? null;
        $accountNo      = $param['account_no'] ?? null;
        $charge         = $param['charge'] ?? null;
        $balance        = $param['balance'] ?? null;

        // Log extracted fields
        \Log::channel('tcb')->info("TCB Callback Extracted:", [
            'status'           => $status,
            'statusDesc'       => $statusDesc,
            'transaction_id'   => $transactionId,
            'reference'        => $reference,
            'amount'           => $amount,
            'currency'         => $currency,
            'transaction_date' => $transactionDate,
            'phone'            => $phone,
            'description'      => $description,
            'account_no'       => $accountNo,
            'charge'           => $charge,
            'balance'          => $balance,
        ]);

        /* OPTIONAL: Update your bills table or mark transaction as paid
        if($status === 0) {
            // Example: find bill by reference and mark as paid
            $bill = \App\Models\Bill::where('control_number', $reference)->first();
            if($bill) {
                $bill->update([
                    'paid' => 1, // make sure you have this column
                    'paid_amount' => $amount,
                    'paid_at' => $transactionDate,
                ]);
            }
        } */

        // Always return OK so TCB doesn't keep retrying
        return response()->json(['status' => 'received'], 200);

    } catch (\Exception $e) {
        \Log::channel('tcb')->error("TCB Callback ERROR: " . $e->getMessage());

        return response()->json(['status' => 'error'], 500);
    }
}





    public function mnoCheckout(Request $request)
    {
        // Sample data from frontend (msisdn, amount, etc.)
        $data = [
            "accountNumber" => $request->accountNumber, // MSISDN
            "amount"        => $request->amount,
            "currency"      => "TZS",
            "externalId"    => uniqid("order_"), // your order id
            "provider"      => $request->provider // Mpesa, Airtel, Tigo, etc.
        ];

        // Get token from .env
        $token = $this->getAccessToken();

        $response = Http::withToken($token)
            ->post("https://sandbox.azampay.co.tz/azampay/mno/checkout", $data);

        return $response->json();
    }

 public function getAccessToken()
{
    $url = "https://authenticator-sandbox.azampay.co.tz/AppRegistration/GenerateToken";

    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
    ])->post($url, [
        'appName'      => config('services.azampay.app_name'),
        'clientId'     => config('services.azampay.client_id'),
        'clientSecret' => config('services.azampay.client_secret'),
    ]);

    if (!$response->successful()) {
        \Log::error('AzamPay Token Request Failed', [
            'status' => $response->status(),
            'body'   => $response->body(),
        ]);
        return null;
    }

    $data = $response->json();
    return $data['data']['accessToken'] ?? null;
}

    
}
