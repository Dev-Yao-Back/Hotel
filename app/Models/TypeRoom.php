<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeRoom extends Model
{
    use HasFactory;

    protected $table = 'type_rooms';

    protected $fillable=['uname'];

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_type_room');
    }
    
     // Définir la relation avec Pricing
     public function pricings()
     {
         return $this->hasMany(Pricing::class, 'room_type_id');
     }

}
