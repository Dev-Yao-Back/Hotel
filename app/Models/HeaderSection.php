<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'call_number', 'location', 'social_facebook',
        'social_twitter', 'social_instagram', 'social_tiktok'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
