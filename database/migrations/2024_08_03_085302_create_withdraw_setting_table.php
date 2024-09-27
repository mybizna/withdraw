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
            $table->foreignId('partner_id')->nullable()->constrained('partner_partner')->onDelete('set null');
            $table->foreignId('gateway_id')->nullable()->constrained('account_gateway')->onDelete('set null');
            $table->longText('params')->nullable();
            $table->string('account')->nullable();

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
        Schema::dropIfExists('withdraw_setting');
    }
};
