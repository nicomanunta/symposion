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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('event_locations')->onDelete('set null');

            $table->unsignedBigInteger('dress_code_id')->nullable();
            $table->foreign('dress_code_id')->references('id')->on('event_dress_codes')->onDelete('set null');

            $table->string('event_title', 50);
            $table->string('event_subtitle', 100)->nullable();
            $table->text('event_description')->nullable();
            $table->string('event_region', 50);
            $table->string('event_city', 50);
            $table->string('event_address', 100);
            $table->date('event_date');
            $table->time('event_start');
            $table->time('event_end')->nullable();
            $table->decimal('event_price', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
