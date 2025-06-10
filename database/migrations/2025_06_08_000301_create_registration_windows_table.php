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
        Schema::create('registration_windows', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(false);
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->integer('max_registrations')->default(30);
            $table->string('password')->nullable();
            $table->dateTime('first_use_time')->nullable();
            $table->integer('current_registrations')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration_windows');
    }
};
