<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'booking_id', 'amount', 'payment_method', 'payment_date', 'status',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
