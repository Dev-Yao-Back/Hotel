<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSection extends Model
{
    use HasFactory;

    protected $fillable = ['hotel_id', 'icon', 'title', 'description'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
