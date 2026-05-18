<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



use App\Models\Region;
class RegionController extends Controller
{
    public function index()
    {
        return response()->json(Region::where('status','1')->get(), 200);
    }



    public function store(Request $request)
    {


         $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $region= Region::create(
            [
            'name'=>$request->name,
            'description'=>$request->description
        ]);

        return response()->json([
            'message' => 'Region created successfully',
            'region' => $region
        ], 201);
    }
}
