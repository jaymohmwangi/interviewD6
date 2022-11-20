<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->string('currency')->nullable();
            $table->float('sub_total');
            $table->float('taxable_total')->nullable();
            $table->float('tax_rate')->default(0);
            $table->float('tax_amount');
            $table->float('total_after_tax');
            $table->float('amount_paid')->default(0);
            $table->float('total_amount_due');
            $table->date('invoice_date');
            $table->date('due_date');
            $table->text('notes')->nullable();
            $table->string('status')->comment("PENDING,PARTIAL,PAID");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
