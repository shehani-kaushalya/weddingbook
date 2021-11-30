<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesPromotionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages_promotion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cust_id');
            $table->longText('package_name')->nullable();
            $table->longText('package_description')->nullable();
            $table->longText('promotion_name')->nullable();
            $table->longText('promotion_description')->nullable();
            $table->string('discount')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('discount_percentage')->nullable();
            $table->integer('status')->default('100');
            $table->integer('is_primary')->default(0);
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
        Schema::dropIfExists('packages_promotion');
    }
}