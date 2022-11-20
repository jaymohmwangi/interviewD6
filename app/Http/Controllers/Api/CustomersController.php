<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RawQueries\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{


    public function find(Request $request)
    {
        //validate route parameter-id
        $request->merge(['id' => $request->route('id')]);
        $validator = Validator::make($request->all(), ["id" => 'required|numeric|min:1'], ["id.*" => "Please provide valid customer id!"]);
        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "errors" => ["validation" => [$validator->errors()->first()]],
            ], 422);

        }
        //fnd customer
        $customer = (new Customer())->find("*", "id=$request->id");
        if (empty($customer)) {
            return response()->json([
                "success" => false,
                "errors" => ["customer_error" => ["Customer record not found!"]],
            ], 422);
        }
        return response()->json([
            "success" => true,
            "message" => "Success",
            "customer" => $customer
        ], 200);


    }

}
