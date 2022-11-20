<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

            Schema::create('invoice_items', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('invoice_id');
                $table->foreign('invoice_id')->references('id')->on('invoices')->onUpdate('cascade')->onDelete('cascade');
                $table->string('item_description');
                $table->boolean('item_is_taxable');
                $table->float('item_amount');
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
        Schema::dropIfExists('invoice_items');
    }
}
