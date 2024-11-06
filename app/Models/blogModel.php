<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blogModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'title', 'content',
    ];
    
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}