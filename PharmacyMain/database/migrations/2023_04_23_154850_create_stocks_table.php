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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('med_id');
            $table->string('batch_no');
            $table->date('expiry_date');
            $table->integer('quantity');
            $table->decimal('mrp', 10, 2);
            $table->decimal('buy_price', 10, 3);
            $table->decimal('unit_price', 10, 2);
            $table->decimal('sell_price', 10, 2);
            $table->decimal('total_sell_price', 10, 2);
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
        Schema::dropIfExists('stocks');
    }
};
