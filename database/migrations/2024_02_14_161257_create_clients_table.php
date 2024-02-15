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
        Schema::create('clients', static function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('website')->nullable();
            $table->boolean('is_whatsapp')->default(false);
            $table->boolean('is_active')->default(false);
            $table->timestamps();

            $table->index(['is_active', 'is_whatsapp']);
            $table->fullText(['name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
