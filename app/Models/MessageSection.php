<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'title', 'subtitle', 'background_image',
        'dg_title', 'dg_subtitle', 'dg_message', 'dg_image',
        'dg_signature', 'video_url', 'video_alt'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
