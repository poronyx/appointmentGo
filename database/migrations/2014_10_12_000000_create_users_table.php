<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('race');
            $table->string('phone_number');
            $table->string('nric');
            $table->string('gender');
            $table->string('user_type');
            $table->date('date_of_birth');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            //For Patient
            $table->json('address')->nullable();
            $table->boolean('subscribe_article')->default(0);
            //For Doctor
            $table->string('academic_title')->nullable();
            $table->json('qualifications')->nullable();
            $table->text('summary')->nullable();
            $table->json('specialty')->nullable();
            $table->json('sub_specialty')->nullable();
            $table->string('experience')->nullable();
            //$table->string('availability')->nullable();
            //For Nurse 
            $table->string('department')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
