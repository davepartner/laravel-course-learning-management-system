<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');

            //create course
            $table->integer('category_id');
            
            $table->string('title');
            $table->string('sub_title')->nullable(); 
            $table->longText('description');
            $table->longText('faq')->nullable();
            $table->longText('refund_policy')->nullable();
            $table->longText('about_instructor')->nullable();
            $table->string('playlist_url');
            $table->string('tags')->nullable(); //php, laravel, html
            $table->string('photo')->nullable();
            $table->string('promo_video_url')->nullable();
            $table->integer('creator_status')->default(0); //live: 1, not live:0
            $table->integer('admin_status')->default(0); //live: 1, not live:0


            //target your students
            $table->longText('what_will_students_learn')->nullable();
            $table->longText('target_students')->nullable();
            $table->longText('requirements')->nullable();

            //price and coupons
            $table->double('discount_price', 10, 2); 
            $table->double('actual_price', 10, 2);

            //stats
            $table->integer('main_course_id')->nullable(); //empty
            $table->integer('summary_course_id')->nullable(); //empty
            $table->integer('view_count')->default(0)->nullable();
            $table->integer('subscriber_count')->default(0)->nullable();
         

            $table->softDeletes(); //deleted_at
            $table->timestamps();  //created_at updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
