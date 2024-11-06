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
        Schema::create('pricings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_type_id'); // Clé étrangère vers room_types
            $table->string('duration'); // Ex. '2h', '3h', 'nuitée', etc.
            $table->decimal('price', 8, 2); // Prix, avec deux décimales
            $table->text('description')->nullable(); // Description optionnelle du tarif
            // Définition de la contrainte de clé étrangère
            $table->foreign('room_type_id')->references('id')->on('type_rooms')
                  ->onDelete('cascade'); // Supprimer les tarifs si le type de chambre est supprimé
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricings');
    }
};
