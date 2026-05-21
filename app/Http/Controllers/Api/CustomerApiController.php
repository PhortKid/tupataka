<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CustomerApiController extends Controller
{
    /**
     * Njia ya kusajili mteja mpya (Store).
     */
    public function index(): JsonResponse
    {
        $latest_customers = Customer::latest()->take(3)->select('fullname_business_name', 'customer_type', 'created_at')->get(); 
        $customers = Customer::all(); 
        $total_registered = $customers->count();
        $today_registered = $customers->where('created_at', '>=', now()->startOfDay())->count();
        $comfirmed_customers = $customers->where('is_confirmed', true)->count();
        $pending_customers = $customers->where('is_confirmed', false)->count();
        $regular_customers = $customers->where('customer_type', 'regular')->count();
        $irregular_customers = $customers->where('customer_type', 'irregular')->count();
        return response()->json([
            'success' => true,
            'customer' => $latest_customers,
            'statistics' => [
                'total_registered' => $total_registered,
                'today_registered' => $today_registered,
                'confirmed_customers' => $comfirmed_customers,
                'pending_customers' => $pending_customers,
                'regular_customers' => $regular_customers,
                'irregular_customers' => $irregular_customers
            ]
        ], 200);
    }


    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'fullname_business_name' => 'required|string|max:255',
            'firstname' => 'nullable|string|max:100',
            'middlename' => 'nullable|string|max:100',
            'lastname' => 'nullable|string|max:100',
            'phone_number' => 'nullable|string|max:20',
            'reg_no' => 'nullable|string|unique:customers,reg_no',
           
            'gps_coordinates' => 'nullable|string',
            'ward_id' => 'nullable|integer',
            'district_id' => 'nullable|integer',
            'region_id' => 'nullable|integer',
            'street_id' => 'nullable|integer',
            'house_no' => 'nullable|string|max:50',
            'house_owner_mobile' => 'nullable|string|max:20',
            'idadi_kaya' => 'nullable|integer',
            'business_activity_id' => 'nullable|integer',
            'customer_type' => 'nullable|string',
            'irregular_amount' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Uthibitishaji umefeli (Validation Error)',
                'errors' => $validator->errors()
            ], 422);
        }
      
        $data = $request->all();

        
        $data['registered_by'] = Auth::id();

    
        $customer = Customer::create($data);
       

      //  $customer = Customer::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Mteja amesajiliwa kikamilifu.',
            'data' => $customer
        ], 201);
    }


    //method to get customer by street id
    public function getByStreet($street_id): JsonResponse
    {
        $customers = Customer::where('street_id', $street_id)->get();   
        return response()->json([
            'success' => true,
            'data' => $customers
        ], 200);
    }

    /**
     * Njia ya kusasisha GPS coordinates pekee (Update GPS).
     */
    public function updateGps(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'gps_coordinates' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Tafadhali weka majira sahihi ya GPS',
                'errors' => $validator->errors()
            ], 422);
        }

        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Mteja hajapatikana'
            ], 404);
        }

        $customer->update([
            'gps_coordinates' => $request->gps_coordinates
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Majira ya GPS yamesasishwa kikamilifu.',
            'data' => [
                'id' => $customer->id,
                'fullname_business_name' => $customer->fullname_business_name,
                'gps_coordinates' => $customer->gps_coordinates
            ]
        ], 200);
    }
}
