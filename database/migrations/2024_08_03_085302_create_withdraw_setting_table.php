<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('withdraw_setting', function (Blueprint $table) {
            $table->id();

            $table->string('id_passport')->nullable();
            $table->string('govt_pin')->nullable();
            $table->integer('partner_id')->nullable();
            $table->bigInteger('gateway_id')->nullable();
            $table->longText('params')->nullable();
            $table->string('account')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraw_setting');
    }
};
