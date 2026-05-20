
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\WardController;
use App\Http\Controllers\StreetController;
use App\Http\Controllers\CollectMoneyController;
use App\Http\Controllers\AzamPayController;
use App\Http\Controllers\TcbController;




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/register_demo_role', function (Request $request) {

    $role =Role::create([
        'name' => 'user_management',
    ]);

});


Route::get('/register_demo_admin', function (Request $request) {

    $user = User::create([
        'name' => 'Admin',
        'email' => 'middelphort@gmail.com',
        'password' =>'admin123',
        'role_id' => 1, 
        'status' => 'active',
    ]);

});

// Region
Route::get('/regions', function() {
    return response()->json(\App\Models\Region::where('status','1')->get());
});
Route::get('/regions/{id}', function($id) {
    return response()->json(\App\Models\Region::findOrFail($id));
});

// District
Route::get('/districts', [DistrictController::class, 'fetch']);
Route::get('/districts/{id}', [DistrictController::class, 'show']);
Route::get('/districts/by-region/{region_id}', [DistrictController::class, 'getByRegion']);
Route::post('/districts', [DistrictController::class, 'store']);
Route::put('/districts/{id}', [DistrictController::class, 'update']);
Route::delete('/districts/{id}', [DistrictController::class, 'destroy']);

// Ward
Route::get('/wards', [WardController::class, 'fetch']);
Route::get('/wards/{id}', [WardController::class, 'show']);
Route::post('/wards', [WardController::class, 'store']);
Route::put('/wards/{id}', [WardController::class, 'update']);
Route::delete('/wards/{id}', [WardController::class, 'destroy']);

// Street
Route::get('/streets', [StreetController::class, 'fetch']);
Route::get('/streets/{id}', [StreetController::class, 'show']);
Route::post('/streets', [StreetController::class, 'store']);
Route::put('/streets/{id}', [StreetController::class, 'update']);

Route::get('/streets/by-ward/{id}', [StreetController::class, 'getByWard']);

Route::delete('/streets/{id}', [StreetController::class, 'destroy']);


// Wards by District (for dynamic filtering)
Route::get('/wards/by-district/{district_id}', [App\Http\Controllers\WardController::class, 'getByDistrict']);

Route::post('/get_regular_customer/by_street/{street_id}', [App\Http\Controllers\CollectMoneyController::class, 'getRegular']);
Route::post('/get_irregular_customer/by_street/{street_id}', [App\Http\Controllers\CollectMoneyController::class, 'getIrregular']);



Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);


Route::get('demo', function () {
    return response()->json([
        'message' => 'This is a demo endpoint',
        'status' => 'success'
    ]);
})->middleware('auth:sanctum');



Route::get('/get_region', [App\Http\Controllers\Api\RegionController::class, 'index']);

Route::post('/add_region', [App\Http\Controllers\Api\RegionController::class, 'store']);


Route::post('/add_regular_customer',[\App\Http\Controllers\RegularCustomerController::class,'store']);
Route::post('/add_irregular_customer',[\App\Http\Controllers\IrregularCustomerController::class,'store']);



Route::get('/get_business_activity', [App\Http\Controllers\BusinessActivityController::class, 'fetch']);



Route::post('/azam/callback', [AzamPayController::class, 'callback']);



Route::any('/tcb/callback', [TcbController::class, 'callback']);

Route::post('/azam/mnocheckout', [AzamPayController::class, 'mnoCheckout']);


Route::any('/tcb-callback-result', function () {

    $raw = \App\Models\AzamTransaction::pluck('raw_payload');
    $cleanData = [];

    foreach ($raw as $item) {

        // Decode raw JSON string
        $decoded = json_decode($item, true);

        // Skip empty values
        if (empty($decoded)) {
            continue;
        }

        // Push decoded array (NOT encoded again)
        $cleanData[] = $decoded;
    }

    return response()->json([
        'data' => $cleanData,
    ]);
});


Route::post('/tcb-test', function () {
    // Create payment reference
   // $referenceResponse = TCBBankAPI::createReference('150400000034', 'QSL123456789', 'Phort Chrispin', '255787753939', 'Api Testing');

    $response = TCBBankAPI::reconcile('2025-11-01', '2025-11-21');

    return response()->json([
        'reference' => $response,
       
    ]);

    }



);


use App\Http\Controllers\Api\CustomerApiController;

Route::get('/customers_stats', [CustomerApiController::class, 'index']);
Route::post('/customers', [CustomerApiController::class, 'store']);
Route::get('/customers/by_street/{street_id}', [CustomerApiController::class, 'getByStreet']);
// Route ya kusasisha GPS pekee
Route::patch('/customers/{id}/gps', [CustomerApiController::class, 'updateGps']);

