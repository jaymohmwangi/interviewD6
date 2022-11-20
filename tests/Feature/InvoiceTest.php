<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_should_open_add_invoice_form()
    {
        $response = $this->get('/invoice/add');

        $response->assertStatus(200);
    }
    public function test_it_should_fail_validation_when_creating_invoice_without_customer_id()
    {
        $response = $this->post('/api/invoice/store',[
            "customer_id" => "",
            "invoice_date" => "2022-11-20",
            "due_date" => "2022-11-20",
            "currency" => "ZAR",
            "description" => [
                "Website Hosting",
                "Domain"
            ],
            "amount" => [
                "10",
                "20"
            ],
            "taxed" => [
                "20.00"
            ],
            "notes" => "Notes",
            "sub_total" => "30.00",
            "taxable_total" => "20",
            "tax_rate" => "2",
            "tax_amount" => "0.40",
            "total_after_tax" => "30.4",
            "amount_paid" => "0.4",
            "amount_due" => "30.00"
        ],[
            "Content-Type"=>"application/json"
        ]);
        $response->assertStatus(422)->assertJson([
            'success' => false
        ]);
    }
    public function test_it_should_create_invoice_successfully()
    {

        $response = $this->post('/api/invoice/store',[
                "customer_id" => "2",
                "invoice_date" => "2022-11-20",
                "due_date" => "2022-11-20",
                "currency" => "ZAR",
                "description" => [
                    "Test generate 1",
                    "Test generate 2"
                ],
                "amount" => [
                    "10",
                    "20"
                ],
                "taxed" => [
                    "20.00"
                ],
                "notes" => "Notes",
                "sub_total" => "30.00",
                "taxable_total" => "20",
                "tax_rate" => "2",
                "tax_amount" => "0.40",
                "total_after_tax" => "30.4",
                "amount_paid" => "0.4",
                "amount_due" => "30.00"
        ]);
        $response->assertStatus(201)
        ->assertJson([
            'success' => true,
            'message' => 'Success',
    ]);
    }
}
