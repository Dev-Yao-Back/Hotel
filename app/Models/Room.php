<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'type_id',
        'name',
        'price',
        'description',
        'capacity',
        'number_of_beds',
        'number_of_baths',
        'amenities',
        'images',
        'status',
        'photo1',
        'photo2',
        'photo3',
        'photo4',
        'video',
        'room_amenities'
    ];

  public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function services()
    {
        return $this->belongsToMany(Service::class, 'room_services');
    }
    public function mediaGallery()
    {
        return $this->hasMany(MediaGallery::class);

    }
    // Définir la relation avec Pricing
    public function pricings()
    {
        return $this->hasMany(Pricing::class, 'room_type_id');
    }
    public function type_rooms()
    {
        return $this->belongsTo(TypeRoom::class, 'type_id');
    }
    public function isAvailable()
    {
        return !$this->bookings()->where('check_out_date', '>', now())->count();
    }

}
