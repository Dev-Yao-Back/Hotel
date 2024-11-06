<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;

    protected $fillable = [
        'compte_id', 'categorie_depense_id', 'hotel_id' , 'date', 'amount', 'detail'
    ];

    public function compte(){

        return $this->belongsTo(Compte::class);
    }
    public function hotel(){

        return $this->belongsTo(Hotel::class);
    }

     public function categorie_depense(){

        return $this->belongsTo(CategorieRevenu::class);
    }

    public function Hotels()
{
    return $this->belongsTo(Hotel::class);
}



}