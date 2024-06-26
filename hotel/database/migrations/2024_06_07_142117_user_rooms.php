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

        Schema::create('status', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('user_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_num');
            $table->string('checkin');
            $table->string('checkout');
            $table->foreignId('status_id')->constrained('status');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('room_id')->constrained('rooms');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_rooms');
        Schema::dropIfExists('status');
    }
};

