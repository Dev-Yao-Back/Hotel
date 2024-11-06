<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
   

    use HasFactory;

    protected $fillable = [
        'user_id', 'room_id', 'nom_famille', 'prenom', 'genre', 'telephone', 'email', 'adresse', 'check_in_date', 'check_out_date', 'total_price', 'payment_status', 'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

     // Les attributs de date sont automatiquement castés en instances de Carbon
     protected $casts = [
        'check_in_date' => 'datetime',
        'check_out_date' => 'datetime',
    ];
}
