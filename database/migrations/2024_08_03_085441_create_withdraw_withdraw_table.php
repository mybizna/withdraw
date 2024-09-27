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
            $table->foreignId('currency_id')->nullable()->constrained('core_currency')->onDelete('set null');
            $table->longText('description')->nullable();
            $table->boolean('paid_status')->nullable()->default(false);
            $table->boolean('is_canceled')->nullable()->default(false);
            $table->string('token')->nullable();
            $table->longText('params')->nullable();
            $table->foreignId('gateway_id')->nullable()->constrained('account_gateway')->onDelete('set null');
            $table->foreignId('partner_id')->nullable()->constrained('partner_partner')->onDelete('set null');

            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('deleted_by')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
            $table->softDeletes();

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
