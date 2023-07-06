<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('med_id')->nullable();
            $table->integer('mf_id');
            $table->integer('batch_no')->unique();
            $table->integer('invoice_no')->unique();
            $table->date('expiry_date');
            $table->date('purchase_date');
            $table->integer('units');
            $table->decimal('unit_price', 10, 2);
            $table->integer('sales_tax');
            $table->string('desc')->nullable();
            $table->integer('total_price');
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
        Schema::dropIfExists('purchases');
    }
};
