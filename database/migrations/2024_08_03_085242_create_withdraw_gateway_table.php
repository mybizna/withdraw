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
        Schema::create('withdraw_gateway', function (Blueprint $table) {
            $table->id();

            $table->string('label');
            $table->longText('instruction');
            $table->foreignId('gateway_id')->constrained('account_gateway')->onDelete('cascade')->nullable()->index('withdraw_gateway_gateway_id');
            $table->longText('file_structure');
            $table->longText('file_prefix')->nullable();
            $table->longText('file_suffix')->nullable();
            $table->string('file_type')->nullable();
            $table->integer('file_limit')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraw_gateway');
    }
};
