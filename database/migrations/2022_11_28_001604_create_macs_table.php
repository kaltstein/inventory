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
        Schema::create('macs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('asset_no')->nullable();
            $table->string('FA_control_no')->nullable();
            $table->string('specs')->nullable();
            $table->string('branch')->nullable();
            $table->string('warranty_check')->nullable();
            $table->string('warranty')->nullable();
            $table->date('date_released')->nullable();
            $table->string('supplier')->nullable();
            $table->string('system_sn')->nullable();
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
        Schema::dropIfExists('macs');
    }
};
