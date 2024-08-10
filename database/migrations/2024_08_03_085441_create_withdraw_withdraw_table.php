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
        Schema::create('withdraw_withdraw', function (Blueprint $table) {
            $table->id();

            $table->decimal('amount', 11);
            $table->foreignId('currency_id')->constrained('core_currency')->onDelete('cascade')->nullable()->index('withdraw_withdraw_currency_id');
            $table->longText('description')->nullable();
            $table->boolean('paid_status')->nullable()->default(false);
            $table->boolean('is_canceled')->nullable()->default(false);
            $table->string('token')->nullable();
            $table->longText('params')->nullable();
            $table->foreignId('gateway_id')->constrained('account_gateway')->onDelete('cascade')->nullable()->index('withdraw_withdraw_gateway_id');
            $table->foreignId('partner_id')->constrained('partner_partner')->onDelete('cascade')->nullable()->index('withdraw_withdraw_partner_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraw_withdraw');
    }
};
