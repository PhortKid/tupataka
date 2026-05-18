<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IrregularCustomer;
use App\Models\RegularCustomer;

class CollectMoneyController extends Controller
{
    public function getIrregular(Request $request ,$id){

        $irregular_customers=IrregularCustomer::where('street_id',$id)->where('status','1')->get();

         return response()->json([
            'message' => 'success',
            'irregular_customers' => $irregular_customers
          ], 201);

    }

     public function getRegular(Request $request ,$id){
        
        
        $regular_customers=RegularCustomer::where('street_id',$id)->where('status','1')->get();

         return response()->json([
            'message' => 'success',
            'regular_customers' => $regular_customers
          ], 201);
    }
}
