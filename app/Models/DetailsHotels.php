<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsHotels extends Model
{
    use HasFactory;

    // Spécifiez le nom de la table si ce n'est pas la forme plurielle du nom du modèle
    protected $table = 'details_hotels';

    // Les attributs que vous pouvez assigner en masse
    protected $fillable = [
        'hotel_id',
        'image',
        'logo',
        'image_hero_1',
        'image_hero_2',
        'image_hero_3',
        'address',
        'email',
        'facebook_url',
        'instagram_url',
        'maintenance_mode'
    ];

    // Relation avec le modèle Hotel
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}
