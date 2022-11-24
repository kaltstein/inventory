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
        Schema::create('hardware', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name');
            $table->string('asset_no')->nullable();
            $table->string('brand')->nullable();
            $table->string('specs')->nullable();
            $table->string('supplier')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('service_tag')->nullable();
            $table->string('FA_control_no')->nullable();
            $table->date('date_released')->nullable();
            $table->string('status')->default('active');
            $table->foreign('user_id')->references('id')->on('portal_db.users');
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
        Schema::dropIfExists('hardware');
    }
};
