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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('type', \App\Models\Order::getTypes());
            $table->integer('table_number')->nullable();
            $table->decimal('service_charge')->nullable();
            $table->string('waiter_name')->nullable();
            $table->decimal('delivery_fees')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_phone_number')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
