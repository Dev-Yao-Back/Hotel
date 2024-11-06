<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescriptionSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'title', 'subtitle', 'content',
        'button_text', 'button_link', 'image_1', 'image_2', 'image_3'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
