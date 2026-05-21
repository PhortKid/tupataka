<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserManagementController;
use App\Models\Permission;
use App\Models\User;
use App\Models\TcbTransaction;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\RegularCustomerBillController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PayeeController;
use App\Http\Controllers\PettyCashSourceController;
use App\Http\Controllers\PettyCashReceivedController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\FuelStationController;
use App\Http\Controllers\FuelRateController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FuelIssueController;
use App\Http\Controllers\TruckServiceController;
use App\Http\Controllers\SystemLogController;
use App\Services\SmsService;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

Route::get('/logs/tcb', [SystemLogController::class, 'tcbLogs'])->name('logs.tcb');


 Route::get('/logs', function () {

         $path = storage_path('logs/tcb.log');

        if (!File::exists($path)) {
            return "TCB log file not found.";
        }

        // Soma file contents
        $logs = File::get($path);

        // Reverse order (ya mwisho juu)
        $logs = implode("\n", array_reverse(explode("\n", $logs)));
      
        return view('tcb',compact('logs'));
    }); 

Route::middleware('auth')->group(function () {


 
    Route::get('/', function () {

        $regularCustomers = \App\Models\RegularCustomer::count();
        $irregularCustomers = \App\Models\IrregularCustomer::count();
        $regularCustomerBills = \App\Models\RegularCustomerBill::sum('rate');
        $regions = \App\Models\Region::count();
        $districts = \App\Models\District::count();
        $wards = \App\Models\Ward::count();
        $streets = \App\Models\Street::count();
        $users = \App\Models\User::count();
        
        
         // 1. Date filter (default today)
    $date = now()->format('Y-m-d');

   

    // 3. Calculate Today's Revenue (sum of amount for today)
    $todayRevenue = TcbTransaction::whereDate('transaction_date', now())
                        ->sum('amount');

    // 4. Calculate Monthly Revenue (sum of amount for current month)
    $monthlyRevenue = TcbTransaction::whereYear('transaction_date', now()->year)
                        ->whereMonth('transaction_date', now()->month)
                        ->sum('amount');
        
        
        return view('dashboard.index',compact('regularCustomers', 'irregularCustomers', 'regularCustomerBills', 'regions', 'districts', 'wards', 'streets','users','todayRevenue','monthlyRevenue'));
    }); 

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/weo_staff_management', \App\Http\Controllers\WeoStaffController::class);
    Route::resource('/region_management', \App\Http\Controllers\RegionController::class);
    Route::resource('/district_management', \App\Http\Controllers\DistrictController::class);
    Route::resource('/ward_management', \App\Http\Controllers\WardController::class);
    Route::resource('/street_management', \App\Http\Controllers\StreetController::class);


    Route::resource('/vehicle', \App\Http\Controllers\VehicleController::class);
    Route::resource('/vehicle_service_category', \App\Http\Controllers\VehicleServiceCategoryController::class);



//roles and permission

    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');


    Route::resource('permissions', PermissionController::class)->only(['index', 'store', 'destroy']);
    Route::get('/roles/{id}/permissions', [RoleController::class, 'editPermissions'])->name('roles.permissions.edit');
    Route::put('/roles/{id}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.permissions.update');


    //profile
    Route::get('/profile', [ProfilesController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfilesController::class, 'update'])->name('profile.update');
    Route::post('/profile/change-password', [ProfilesController::class, 'changePassword'])->name('profile.changePassword');
    Route::resource('/users_management',UserManagementController::class);
    //Customer Form
    Route::resource('/regular_customers',\App\Http\Controllers\RegularCustomerController::class);
    Route::resource('/irregular_customers',\App\Http\Controllers\IrregularCustomerController::class);
    //BILLS
    Route::resource('/regular_customer_bill_management',\App\Http\Controllers\RegularCustomerBillController::class);
    Route::resource('/designation',\App\Http\Controllers\DesignationController::class);
    Route::resource('/staff',\App\Http\Controllers\StaffController::class);
    Route::resource('/business_activity',\App\Http\Controllers\BusinessActivityController::class);
    Route::resource('/payee',\App\Http\Controllers\PayeeController::class);
    Route::resource('/pettycashsource',\App\Http\Controllers\PettyCashSourceController::class);
    Route::resource('/pettycash_received',\App\Http\Controllers\PettyCashReceivedController::class);
    Route::resource('/expense_category',\App\Http\Controllers\ExpenseCategoryController::class);
    Route::resource('/fuel_station',FuelStationController::class);
    Route::resource('/fuel_rate',FuelRateController::class);
    Route::resource('/expenses',ExpenseController::class);
    Route::resource('/expenses',ExpenseController::class);
    Route::resource('/fuel_issues',FuelIssueController::class);
    Route::resource('/truck_services',TruckServiceController::class);
    
    
      


});



Route::get('tcb/transactions', [\App\Http\Controllers\TcbController::class, 'index'])
    ->name('transactions.index');





    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
    //Route::post('/logoutt', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);

    /*
    require __DIR__.'/auth.php';
    */


use App\Http\Controllers\CsvImportController;

// Route ya kuonyesha fomu
Route::get('/import-customers', [CsvImportController::class, 'showForm'])->name('import.form');

// Route ya ku-process CSV
Route::post('/import-customers', [CsvImportController::class, 'importCsv'])->name('import.process');






    



    





    Route::get('add_demo_user',function(){

        User::create([
        'name' => 'Yusto',
        'email' => 'yusto@gmail.com',
        'password' => Hash::make('yusto@gmail.com'), 
        'role_id' => 1, 
        'status' => 'active',
        ]);

        return 'user added';
    });

     

      Route::get('/send_demo_sms',function(){

       $sms = new SmsService();

         try {
            $response = $sms->send("Hello, hii ni test message", "255787753939");
            return response()->json(['success' => true, 'data' => $response]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }

    });



        Route::get('test',function(){

           

            return view('test');
        });


        use App\Models\BusinessActivity;

        Route::get('add_demo_business_activity',function(){
            BusinessActivity::create([
                'name' => 'Demo Business Activity',
                'description' => 'This is a demo business activity',
            ]);

            return 'Business Activity added';
        });


        

        use Quicksoftapp\TCBBankAPI\Facades\TCBBankAPI;






    Route::get('/reconciliation', function () {
    
  $response = TCBBankAPI::cancelReference('112XXXXXXX', '999ABCXXXX');

    return $response;
}); // Protects route


Route::get('/check_data', function () {

         Schema::create('designation', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->enum('status', ['0', '1'])->default('1');
            $table->timestamps();
        });

  return 'done';
}); // Protects route

//Confirm Verified Customer Route
Route::post('/confirm_verified_customer', [\App\Http\Controllers\RegularCustomerController::class, 'verify'])->name('confirm.verified.customer');

use App\Http\Controllers\BillGenerateController;

Route::get('/bills', [BillGenerateController::class, 'index'])->name('bills.index');
Route::post('/bills/individual', [BillGenerateController::class, 'storeIndividual'])->name('bills.individual');
Route::post('/bills/bulk', [BillGenerateController::class, 'storeBulk'])->name('bills.bulk');

