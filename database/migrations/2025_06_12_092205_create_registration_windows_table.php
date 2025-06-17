<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationWindowsTable extends Migration
{
    public function up()
    {
        Schema::create('registration_windows', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(false);
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->integer('max_registrations')->nullable();
            $table->string('password')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registration_windows');
    }
}
