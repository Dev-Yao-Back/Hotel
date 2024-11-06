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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hotel_id');
            $table->unsignedBigInteger('type_id');
            $table->string('name')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->text('description')->nullable();
            $table->integer('capacity')->nullable();
            $table->integer('number_of_beds')->nullable();
            $table->integer('number_of_baths')->nullable();
            $table->text('amenities')->nullable(); // JSON or comma-separated values
            $table->text('images')->nullable(); // JSON or comma-separated image URLs
            $table->string('status');
            $table->timestamps();
            // Foreign key constraints
            $table->foreign('hotel_id')->references('id')->on('hotels')
                  ->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('type_rooms')
                  ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
