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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('uname');
            $table->string('location')->nullable();
            $table->string('adresse')->nullable();
            $table->text('description')->nullable();;
            $table->unsignedBigInteger('group_hotels_id');
            $table->foreign('group_hotels_id')->references('id')->on('group_hotels');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
