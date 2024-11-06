<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'ax',
        'ay',
        'libelle',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}