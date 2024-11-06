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
        Schema::create('footer_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade');
            $table->text('about_description')->nullable();
            $table->string('contact_call')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_location')->nullable();
            $table->json('useful_links')->nullable();
            $table->string('newsletter_title')->nullable();
            $table->string('newsletter_placeholder')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer_sections');
    }
};
