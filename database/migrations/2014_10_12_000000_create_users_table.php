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
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('phone_verify_code')->nullable();
            $table->integer('verify_status')->nullable();
            $table->integer('verify_count')->nullable();
            $table->timestamp('phone_verify_at')->nullable();
            $table->string('email')->unique();
            $table->date('dob')->format('yyyy-mm-dd')->nullable();
            $table->string('image')->nullable();
            $table->integer('type')->nullable();
            $table->integer('status');
            $table->integer('step')->default('1');
            $table->longText('about')->nullable();
            $table->text('message')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('provider')->nullable();
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