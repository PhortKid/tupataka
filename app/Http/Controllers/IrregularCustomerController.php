<?php

namespace App\Http\Controllers;


use App\Models\IrregularCustomer;
use App\Models\RegularCustomer;
use App\Models\Region;
use App\Models\District;
use App\Models\Ward;
use App\Models\Street;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class IrregularCustomerController extends Controller
{
    public function index()
    {
        $districts = \App\Models\District::where('status','1')->get();
        $regions = \App\Models\Region::where('status','1')->get();
        $wards = \App\Models\Ward::where('status','1')->get();
        $streets= \App\Models\Street::where('status','1')->get();
        $customers = IrregularCustomer::latest()->with(['region', 'district', 'ward', 'street'])->paginate(10);
        return view('dashboard.irregular_customer.index', compact('customers','districts', 'regions','streets','wards'));
    }


    public function verify(Request $request)
    {
       $customer= VerifiedCustomer::create(
           [
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'customer_type' => $request->customer_type,
            'business_activity_id' => $request->business_activity_id,
            'customer_id' => $request->customer_id,
            'control_number' => '',//'QSL'. $control_number = now()->format('Ymd') . $request->customerid,
            'status' => '1',
            ]
     );


        $control_number = 'QSL'. $control_number = now()->format('Ymd')  . $customer->id;

        $customer->update(['control_number' => $control_number]);

        IrregularCustomer::where('id', $request->customer_id)->update(['is_confirmed' => '1']);

       return redirect()->back()->with('success', 'Customer verified successfully');

        
        
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
        'company_or_institution_name' => 'required',
        'tin' => 'required|numeric',
        'phone_number' => 'required|string|unique:irregular_customer,phone_number',
        'ward_id' => 'required|exists:ward,id',
        'district_id' => 'required|exists:district,id',
        'region_id' => 'required|exists:region,id',
        'street_id' => 'required|exists:street,id',
        'plot_no' => 'nullable|string|max:255',
        'house_owner_mobile' => 'required|string|max:255',
        'business_activity_id' => 'required',
        'user_id' => 'required',
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

    // Tumia transaction kwa usalama zaidi
    DB::transaction(function () use ($request) {
        // Count existing customers (regular + irregular) with same location
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

        $reg_no = $request->region_id .
                  $request->district_id .
                  $request->ward_id  .
                  $request->street_id . '-' .
                  $nextNumber;

        // Create IrregularCustomer with reg_no
        IrregularCustomer::create([
            'company_or_institution_name' => $request->company_or_institution_name,
            'tin' => $request->tin,
            'phone_number' => $request->phone_number,
            'ward_id' => $request->ward_id,
            'district_id' => $request->district_id,
            'region_id' => $request->region_id,
            'street_id' => $request->street_id,
            'plot_no' => $request->plot_no,
            'house_owner_mobile' => $request->house_owner_mobile,
            'business_activity_id' => $request->business_activity_id,
            'user_id' => $request->user_id,
            'reg_no' => $reg_no,
            'gps_coordinates' => $request->gps_coordinates['latitude'] . ',' . $request->gps_coordinates['longitude'],

        ]);
    });
         return response()->json(['status' => 'success', 'message' => 'IrregularCustomer Added']);

       // return redirect()->route('regular-customers.index')->with('success', 'Customer added successfully');

       

       
    }

    public function edit($id)
    {
        $customer = IrregularCustomer::findOrFail($id);
        $regions = Region::all();
        $districts = District::all();
        $wards = Ward::all();
        $streets = Street::all();

        return view('regular_customer.edit', compact('customer', 'regions', 'districts', 'wards', 'streets'));
    }

    public function update(Request $request, $id)
    {
        $customer = IrregularCustomer::findOrFail($id);

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
        $customer = IrregularCustomer::findOrFail($id);
        $customer->delete();

        return redirect()->back()->with('success', 'Customer deleted successfully');
    }
}
