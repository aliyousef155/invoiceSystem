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
            $table->increments('id')->unsigned();
            $table->string('customer_name');
            $table->string('customer_email')->nullable();
            $table->integer('customer_mobile');
            $table->string('description')->nullable();
            $table->integer('invoice_number');
            $table->date('invoice_date');
            $table->decimal('sub_total',8,2)->default(0.00);
            $table->decimal('discount_value',8,2)->default(0.00);
            $table->decimal('vat_value',8,2)->default(0.00);
            $table->decimal('shipping',8,2)->default(0.00);
            $table->decimal('total_due',8,2)->default(0.00);
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