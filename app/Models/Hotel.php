<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_hotels_id','uname', 'location', 'adresse', 'description',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function heros()
    {
        return $this->hasMany(HeroSection::class, );
    }

    public function descriptions()
    {
        return $this->hasOne(DescriptionSection::class);
    }

    public function roomCarousels()
    {
        return $this->hasMany(RoomCarouselSection::class);
    }

    public function extras()
    {
        return $this->hasMany(ExtraSection::class);
    }

    public function messages()
    {
        return $this->hasOne(MessageSection::class);
    }

    public function services()
    {
        return $this->hasMany(ServiceSection::class);
    }

    public function events()
    {
        return $this->hasMany(EventSection::class);
    }

    public function restaurants()
    {
        return $this->hasOne(RestaurantSection::class);
    }

    public function testimonials()
    {
        return $this->hasMany(TestimonialSection::class);
    }

    public function footers()
    {
        return $this->hasOne(FooterSection::class);
    }

    public function headers()
    {
        return $this->hasOne(HeaderSection::class);
    }

    public function bookings()
    {
        return $this->hasManyThrough(Booking::class, Room::class, 'hotel_id', 'room_id', 'id', 'id');
    }

    public function depenses()
{
    return $this->hasMany(Depense::class);
}

    public function mapSections()
    {
        return $this->hasOne(MapSection::class);
    }

}