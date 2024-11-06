<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaGallery extends Model
{
    use HasFactory;

protected $table='media_galleries';

    protected $fillable = [
        'room_id',
        'media_type',
        'media_url'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    
}





