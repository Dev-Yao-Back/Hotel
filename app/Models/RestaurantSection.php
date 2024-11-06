<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'background_image', 'title', 'description',
        'button_text', 'button_link'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
