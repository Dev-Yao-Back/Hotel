<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupHotel extends Model
{
    use HasFactory;
    protected $fillable = [
        'uname', 'location', 'adresse', 'description',
    ];
}
