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
            $table->string('currency_id')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('paid_status')->nullable()->default(false);
            $table->boolean('is_canceled')->nullable()->default(false);
            $table->string('token')->nullable();
            $table->longText('params')->nullable();
            $table->bigInteger('gateway_id')->nullable();
            $table->integer('partner_id')->nullable();

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
