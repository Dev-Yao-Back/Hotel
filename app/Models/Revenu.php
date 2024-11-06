<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'compte_id', 'categorie_revenu_id', 'hotel_id', 'date', 'amount', 'detail'
    ];
    
    public function compte(){
        return $this->belongsTo(Compte::class);
    }
    
    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }
    
    public function categorie_revenu(){
        return $this->belongsTo(CategorieRevenu::class);
    }
    
}