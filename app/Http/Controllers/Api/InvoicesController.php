<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\CreateInvoiceRequest;
use App\Models\RawQueries\Customer;
use App\Models\RawQueries\Invoice;
use App\Models\RawQueries\InvoiceItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class InvoicesController extends Controller
{

    public function store(CreateInvoiceRequest $request)
    {
        //check if customer id is valid
        $customer = (new Customer())->find("*", "id=$request->customer_id");
        if (empty($customer)) {
            return response()->json([
                "success" => false,
                "errors" => ["customer_error" => ["Customer record not found!"]],
            ], 422);
        }
        //create invoice
        $data_invoice=[
            "customer_id"=>$request->customer_id,
            "invoice_date"=>$request->invoice_date,
            "due_date"=>$request->due_date,
            "currency"=>$request->currency,
            "sub_total"=>(float)$request->sub_total,
            "taxable_total"=>(float)$request->taxable_total,
            "tax_rate"=>(float)$request->tax_rate,
            "tax_amount"=>(float)$request->tax_amount,
            "total_after_tax"=>(float)$request->total_after_tax,
            "amount_paid"=>(float)$request->amount_paid,
            "total_amount_due"=>(float)$request->amount_due,
            "notes"=>$request->notes,
            "status"=>($request->amount_due>0)?"PARTIAL":(($request->amount_due<=0)?"PAID":"PENDING"),
            "created_at"=>date("Y-m-d H:i:s")
        ];
        $id=(new Invoice())->insert($data_invoice);
        //create invoice items
        for ($i = 0; $i < count($request->description); $i++){
            $data_invoice_item= array();
            $data_invoice_item["invoice_id"]=$id;
            $data_invoice_item["item_description"]=$request->description[$i];
            $data_invoice_item["item_amount"]=(float)$request->amount[$i];
            $data_invoice_item["item_is_taxable"]=(isset($request->taxed[$i]))?1:0;
            $data_invoice_item["created_at"]=date("Y-m-d H:i:s");
            //save invoice item
            (new InvoiceItems())->insert($data_invoice_item);
        }
        Log::info(json_encode($request->all()));

        return response()->json([
            "success" => true,
            "message" => "Success",
        ], 201);
    }


}
