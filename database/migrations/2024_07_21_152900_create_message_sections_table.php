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
        Schema::create('message_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade');
        $table->string('title')->nullable();
        $table->string('subtitle')->nullable();
        $table->string('background_image')->nullable();
        $table->string('dg_title')->nullable();
        $table->string('dg_subtitle')->nullable();
        $table->text('dg_message')->nullable();
        $table->string('dg_image')->nullable();
        $table->string('dg_signature')->nullable();
        $table->string('video_url')->nullable();
        $table->string('video_alt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_sections');
    }
};
