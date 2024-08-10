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
            $table->foreignId('partner_id')->constrained('partner_partner')->onDelete('cascade')->nullable()->index('withdraw_setting_partner_id');
            $table->foreignId('gateway_id')->constrained('account_gateway')->onDelete('cascade')->nullable()->index('withdraw_setting_gateway_id');
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
