<?php

namespace Tests\Unit;

use App\Models\RawQueries\Invoice;
use App\Models\RawQueries\InvoiceItems;
use Tests\TestCase;

class DatabaseModelTest extends TestCase
{


    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_invoice_model_insert()
    {
       $id= (new Invoice())->insert([
                "customer_id"=>"1",
                "invoice_date"=>date("Y-m-d"),
                "due_date"=>date("Y-m-d"),
                "currency"=>"KES",
                "sub_total"=>"30",
                "taxable_total"=>"0",
                "tax_rate"=>"0",
                "tax_amount"=>"0",
                "total_after_tax"=>"30",
                "amount_paid"=>"0",
                "total_amount_due"=>"30",
                "notes"=>"some noted 1",
                "status"=>"PENDING",
                "created_at"=>date("Y-m-d H:i:s")
        ]);
        $invoice=(new Invoice())->find("*","id=$id");
        $this->assertObjectHasAttribute("customer_id",$invoice);
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_invoice_model_find()
    {
        $id=1;
        $invoice=(new Invoice())->find("*","id=$id");
        $this->assertEquals("1",$invoice->id);
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_invoice_model_update()
    {
        $id=1;
        (new Invoice())->update([
            "amount_paid"=>"10",
            "total_amount_due"=>"20",
            "status"=>"PARTIAL",
            "updated_at"=>date("Y-m-d H:i:s")
        ],1);
        $invoice=(new Invoice())->find("*","id=$id");
        $this->assertEquals("PARTIAL",$invoice->status);
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_invoice_item_model_create()
    {
        $id=1;
        (new InvoiceItems())->insert([
            "invoice_id"=>"1",
            "item_description"=>"Testing invoice item insert",
            "item_amount"=>"30",
            "item_is_taxable"=>"0",
            "created_at"=>date("Y-m-d H:i:s")
        ]);
        $invoice=(new Invoice())->find("*","id=$id");
        $this->assertEquals("PARTIAL",$invoice->status);
    }
}
