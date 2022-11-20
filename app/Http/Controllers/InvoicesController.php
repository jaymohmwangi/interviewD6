<?php

namespace App\Http\Controllers;


use App\Models\RawQueries\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoicesController extends Controller
{



    public function create()
    {
            //get customers
            $customers=(new Customer())->all("*",'',"ORDER BY name ASC");
            return view("pages.invoices.add", compact("customers"));

    }




}
