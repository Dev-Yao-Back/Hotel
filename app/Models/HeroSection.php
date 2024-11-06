<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    use HasFactory;
    protected $fillable = ['hotel_id', 'title', 'subtitle', 'background_image'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
