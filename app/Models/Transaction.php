<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;


    protected $fillable = ['from_compte_id', 'to_compte_id', 'amount', 'date', 'description'];

    public function fromCompte()
    {
        return $this->belongsTo(Compte::class, 'from_compte_id');
    }

    public function toCompte()
    {
        return $this->belongsTo(Compte::class, 'to_compte_id');
    }
}