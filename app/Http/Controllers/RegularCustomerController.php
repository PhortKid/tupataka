<?php

namespace App\Http\Controllers;

use App\Models\RegularCustomer;
use App\Models\IrregularCustomer;
use App\Models\Region;
use App\Models\District;
use App\Models\Ward;
use App\Models\Street;
use App\Models\VerifiedCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
 use Illuminate\Support\Facades\Http;

class RegularCustomerController extends Controller
{
    public function index()
    {
        $districts = \App\Models\District::where('status','1')->get();
        $regions = \App\Models\Region::where('status','1')->get();
        $wards = \App\Models\Ward::where('status','1')->get();
        $streets= \App\Models\Street::where('status','1')->get();
        $customers = \App\Models\Customer::where('status', false)->latest()->with(['region', 'district', 'ward', 'street'])->paginate(20);
        return view('dashboard.regular_customer.index', compact('customers','districts', 'regions','streets','wards'));
    }


    public function verify(Request $request)
    {
         $validator = Validator::make($request->all(), [
        'name' => 'unique:verified_customer,phone_number',
         ]
        );

       $customer= VerifiedCustomer::create(
           [
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'customer_type' => $request->customer_type,
            'business_activity_id' => $request->business_activity_id,
            'customer_id' => $request->customer_id,
            'control_number' => '',
            'status' =>true,
            ]
     );


    $control_number = '999QSL' . str_pad($customer->id, 6, '0', STR_PAD_LEFT);

    $customer->update(['control_number' => $control_number]);

        RegularCustomer::where('id', $request->customer_id)->update(['is_confirmed' => '1']);


        $referenceResponse = \TCBBankAPI::createReference(
        '150400000034', 
        $control_number,          
        $customer->name,         
        $customer->phone_number,  
        'Collection'
    );


  

         return  redirect()->back()->with('success', 'Control Number Created successfully');

     
    
    }


    public function create()
    {
        $regions = Region::all();
        $districts = District::all();
        $wards = Ward::all();
        $streets = Street::all();

        return view('regular_customer.create', compact('regions', 'districts', 'wards', 'streets'));
    }

    public function store(Request $request)
    {
       

        $validator = Validator::make($request->all(), [
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'phone_number' => 'required|string|unique:regular_customer,phone_number',
        'ward_id' => 'required|exists:ward,id',
        'district_id' => 'required|exists:district,id',
        'region_id' => 'required|exists:region,id',
        'street_id' => 'required|exists:street,id',
        'house_no' => 'nullable|string|max:255',
        'house_owner_mobile' => 'required|string|max:255',
        'business_activity_id' => 'required',
        'user_id' => 'required',
        'idadi_kaya' => 'required',
        'gps_coordinates' => 'required',

         'phone_number' => ['required', 'regex:/^255\d{9}$/'],
    'house_owner_mobile' => ['required', 'regex:/^255\d{9}$/'],
], [
    'phone_number.regex' => 'Phone number must start with 255 and be followed by 9 digits.',
    'house_owner_mobile.regex' => 'House owner number must start with 255 and be followed by 9 digits.',


    ]);





    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }
    /*

   DB::transaction(function () use ($request) {
   
    $regularCount = RegularCustomer::where('region_id', $request->region_id)
        ->where('district_id', $request->district_id)
        ->where('ward_id', $request->ward_id)
        ->where('street_id', $request->street_id)
        ->count();

    $irregularCount = IrregularCustomer::where('region_id', $request->region_id)
        ->where('district_id', $request->district_id)
        ->where('ward_id', $request->ward_id)
        ->where('street_id', $request->street_id)
        ->count();

    
    $totalCount = $regularCount + $irregularCount;
    $nextNumber = str_pad($totalCount + 1, 4, '0', STR_PAD_LEFT);
    $reg_no = $request->region_id  . $request->district_id  . $request->ward_id . $request->street_id . '-' . $nextNumber;

    
    RegularCustomer::create([
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'phone_number' => $request->phone_number,
        'ward_id' => $request->ward_id,
        'district_id' => $request->district_id,
        'region_id' => $request->region_id,
        'street_id' => $request->street_id,
        'house_no' => $request->house_no,
        'house_owner_mobile' => $request->house_owner_mobile,
        'business_activity_id' => $request->business_activity_id,
        'reg_no' => $reg_no,
        'user_id' =>$request->user_id,
        'gps_coordinates' => $request->gps_coordinates,

         ]);

    });
         return response()->json(['status' => 'success', 'message' => 'RegularCustomer Added']);

       */

         try {
    DB::transaction(function () use ($request) {
        $regularCount = RegularCustomer::where('region_id', $request->region_id)
            ->where('district_id', $request->district_id)
            ->where('ward_id', $request->ward_id)
            ->where('street_id', $request->street_id)
            ->count();

        $irregularCount = IrregularCustomer::where('region_id', $request->region_id)
            ->where('district_id', $request->district_id)
            ->where('ward_id', $request->ward_id)
            ->where('street_id', $request->street_id)
            ->count();

        $totalCount = $regularCount + $irregularCount;
        $nextNumber = str_pad($totalCount + 1, 4, '0', STR_PAD_LEFT);
        $reg_no = $request->region_id  . $request->district_id  . $request->ward_id . $request->street_id . '-' . $nextNumber;

        RegularCustomer::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phone_number' => $request->phone_number,
            'ward_id' => $request->ward_id,
            'district_id' => $request->district_id,
            'region_id' => $request->region_id,
            'street_id' => $request->street_id,
            'house_no' => $request->house_no,
            'house_owner_mobile' => $request->house_owner_mobile,
            'business_activity_id' => $request->business_activity_id,
            'reg_no' => $reg_no,
            'idadi_kaya' => $request->idadi_kaya,
            'user_id' => $request->user_id,
            'gps_coordinates' => $request->gps_coordinates['latitude'] . ',' . $request->gps_coordinates['longitude'],

        ]);
    });

    return response()->json(['status' => 'success', 'message' => 'RegularCustomer Added']);
} catch (\Exception $e) {
    Log::error('Error adding RegularCustomer: ' . $e->getMessage(), [
        'trace' => $e->getTraceAsString(),
        'input' => $request->all(),
    ]);

    return response()->json([
        'status' => 'error',
        'message' => 'An error occurred while adding the customer.'
    ], 500);
}
    }

    public function edit($id)
    {
        $customer = RegularCustomer::findOrFail($id);
        $regions = Region::all();
        $districts = District::all();
        $wards = Ward::all();
        $streets = Street::all();

        return view('regular_customer.edit', compact('customer', 'regions', 'districts', 'wards', 'streets'));
    }

    public function update(Request $request, $id)
    {
        $customer = RegularCustomer::findOrFail($id);

        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone_number' => 'required|string',
            'ward_id' => 'required|exists:ward,id',
            'district_id' => 'required|exists:district,id',
            'region_id' => 'required|exists:region,id',
            'street_id' => 'required|exists:street,id',
        ]);

        $customer->update($request->all());

        return redirect()->route('regular-customers.index')->with('success', 'Customer updated successfully');
    }

    public function destroy($id)
    {
        $customer = RegularCustomer::findOrFail($id);
        $customer->delete();

        return redirect()->back()->with('success', 'Customer deleted successfully');
    }
}
