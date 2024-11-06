<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    use HasFactory;

    protected $fillable = [
        'compte_number', 'compte_name', 'solde', 'description'
    ];

    public function revenus(){

        return $this->hasMany(Revenu::class);
    }

    public function depenses(){

        return $this->hasMany(Depense::class);
    }

    public function transactionsFrom()
    {
        return $this->hasMany(Transaction::class, 'from_compte_id');
    }

    public function transactionsTo()
    {
        return $this->hasMany(Transaction::class, 'to_compte_id');
    }
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}