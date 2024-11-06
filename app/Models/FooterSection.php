<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'about_description', 'contact_call',
        'contact_email', 'contact_location', 'useful_links',
        'newsletter_title', 'newsletter_placeholder'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
