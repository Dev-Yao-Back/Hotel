<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestimonialSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'title', 'subtitle', 'author', 'rating',
        'description', 'source', 'image'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
