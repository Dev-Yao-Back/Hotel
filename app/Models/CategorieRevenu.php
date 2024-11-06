<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieRevenu extends Model
{
    use HasFactory;
    protected $fillable = [

        'name', 'description'


    ];

    public function revenus(){
        return $this->hasMany(Revenu::class);
    }
}
    