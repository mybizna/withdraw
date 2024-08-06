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
        Schema::create('withdraw_masspay', function (Blueprint $table) {
            $table->id();

            $table->string('year');
            $table->string('month');
            $table->string('date');
            $table->string('token')->nullable();
            $table->boolean('is_processed')->nullable()->default(false);
            $table->string('type');
            $table->integer('max_limit');
            $table->string('file');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraw_masspay');
    }
};
