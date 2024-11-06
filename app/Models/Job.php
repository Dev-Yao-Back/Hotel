<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'salary',
        'date_in',
        'date_out',
        'post',
        'published',
    ];
    
    public function jobApp()
    {
        return $this->hasMany(JobApp::class);
    }
    
}
