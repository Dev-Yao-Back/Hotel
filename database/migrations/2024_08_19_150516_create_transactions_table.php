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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();  // Cette ligne définit la colonne `id` avec auto-incrémentation
            $table->date('date')->notNullable(); // Ajout de la colonne `date`
            $table->foreignId('from_compte_id')->constrained('comptes')->onDelete('cascade'); // ID du compte source
            $table->foreignId('to_compte_id')->constrained('comptes')->onDelete('cascade'); // ID du compte destinataire
            $table->decimal('amount', 15, 2)->notNullable(); // Montant du transfert
            $table->text('description')->nullable(); // Description du transfert
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
