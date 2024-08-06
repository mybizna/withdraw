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
        Schema::create('withdraw_blacklist', function (Blueprint $table) {
            $table->id();

            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->longText('reason')->nullable();
            $table->integer('partner_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraw_blacklist');
    }
};
