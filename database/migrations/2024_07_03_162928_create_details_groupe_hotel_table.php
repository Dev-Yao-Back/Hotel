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
        Schema::create('details_groupe_hotel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('groupe_hotel_id');
            $table->foreign('groupe_hotel_id')->references('id')->on('group_hotels');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details_groupe_hotel');
    }
};
