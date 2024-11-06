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
        Schema::table('details_hotels', function (Blueprint $table) {
            $table->string('logo')->nullable()->after('image')->comment('Chemin du fichier logo');
            $table->string('image_hero_1')->nullable()->comment('Chemin de la première image héroïque');
            $table->string('image_hero_2')->nullable()->comment('Chemin de la deuxième image héroïque');
            $table->string('image_hero_3')->nullable()->comment('Chemin de la troisième image héroïque');
            $table->string('address')->nullable()->after('logo')->comment('Adresse de l\'hôtel');
            $table->string('email')->nullable()->comment('Adresse e-mail de l\'hôtel');
            $table->string('facebook_url')->nullable()->comment('URL de la page Facebook de l\'hôtel');
            $table->string('instagram_url')->nullable()->comment('URL de la page Instagram de l\'hôtel');
            $table->boolean('maintenance_mode')->default(false)->comment('Indicateur de mode maintenance');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('details_hotels', function (Blueprint $table) {
            //
        });
    }
};
