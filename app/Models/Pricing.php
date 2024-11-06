<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory;

    protected $fillable = ['room_type_id', 'duration', 'price', 'description'];

    public function roomType()
    {
        return $this->belongsTo(TypeRoom::class,'room_type_id');
    }



    
}
