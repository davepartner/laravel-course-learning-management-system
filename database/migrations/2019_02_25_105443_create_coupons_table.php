<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('student_id');
            $table->integer('course_id')->nullable();
             $table->integer('category_id')->nullable();
            $table->integer('user_account_id')->nullable();
            $table->string('available_on_course_page')->default('no'); //no, yes
           $table->string('type')->default('free'); //free, discount
            $table->double('price', 8,2);
            $table->string('status')->default('on'); //on, off
            $table->dateTime('deadline'); //default infinte
            $table->float('coundown_timer',3,2)->nullable(); // hours
            $table->integer('total_available');
            $table->integer('total_remaining')->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
