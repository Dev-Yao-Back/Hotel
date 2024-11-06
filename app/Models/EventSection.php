<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'title', 'subtitle',
        'event_title', 'event_date', 'event_description'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
