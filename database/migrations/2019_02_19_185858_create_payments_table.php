<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name_of_depositor');
            $table->longText('proof_of_payment');
             
            $table->string('refund_details')->nullable();
            $table->string('refund_payment_details')->nullable();
            
            $table->integer('category_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->double('amount',10,2);
            $table->string('status')->default('started_payment'); //started payment, returned from payment site,
            $table->string('mode_of_payment')->nullable(); //card, cash, online transfer
            $table->string('payment_processor')->nullable(); //paypal, paystack, stripe
            $table->softDeletes();
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
        Schema::dropIfExists('payments');
    }
}
