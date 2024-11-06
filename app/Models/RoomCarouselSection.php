<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomCarouselSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'title', 'subtitle', 'background_image',
        'button_text', 'button_link'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
