<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Room;

class FrontEndController extends Controller
{
    //

    public function index(){

        $hotel_palace = Hotel::where('id', 1)->first();
        $hotel_signature = Hotel::where('id', 2)->first();
        $hotel_blue = Hotel::where('id', 3)->first();

        return view('frontend.landing.index', compact('hotel_palace', 'hotel_signature', 'hotel_blue'));
    }

    public function choice($id){

        $hotel = Hotel::findOrfail($id);

        $heroes = $hotel->heros->first();

        $descriptions = $hotel->descriptions;


        $roomCarousels = $hotel->roomCarousels->first();


        $rooms = $hotel->rooms;

        session(['hotel' => $hotel, 'hero' => $heroes, 'description' => $descriptions, 'roomCarousel' => $roomCarousels]);

        return redirect()->route('frontend.hotel_index');

    }

    public function hotel(){

        $hotel = Hotel::findOrfail(session('hotel.id'));

        $rooms = $hotel->rooms()->inRandomOrder()->take(6)->get();

        $servicesSection = $hotel->services->first();

        $extrasSection = $hotel->extras->first();

        $messagesSection = $hotel->messages;

        $eventsSection = $hotel->events->first();

        $restoSection = $hotel->restaurants;

        $testimonials = $hotel->testimonials->first();

        $footers = $hotel->footers;

        $headers = $hotel->headers;

        $mapSection = $hotel->mapSections;


        return view('frontend.index', compact('rooms', 'servicesSection', 'extrasSection', 'messagesSection', 'eventsSection', 'restoSection', 'testimonials', 'footers', 'headers', 'mapSection'));

    }

    public function about(){

        $hotel = Hotel::findOrfail(session('hotel.id'));

        $rooms = $hotel->rooms()->inRandomOrder()->take(6)->get();

        $testimonials = $hotel->testimonials->first();

        $footers = $hotel->footers;

        $headers = $hotel->headers;
        $mapSection = $hotel->mapSections;

        return view('frontend.pages.about', compact('rooms',  'testimonials', 'footers', 'headers', 'mapSection'));
    }

    public function job(){

        $hotel = Hotel::findOrfail(session('hotel.id'));

        $rooms = $hotel->rooms()->inRandomOrder()->take(6)->get();


        $testimonials = $hotel->testimonials->first();

        $footers = $hotel->footers;

        $headers = $hotel->headers;

        return view('frontend.pages.job', compact('rooms', 'testimonials', 'footers', 'headers'));
    }
    public function resto(){

        $hotel = Hotel::findOrfail(session('hotel.id'));

        $testimonials = $hotel->testimonials->first();

        $footers = $hotel->footers;

        $headers = $hotel->headers;

        return view('frontend.pages.resto', compact('testimonials', 'footers', 'headers'));
    }
    public function rooms(){

        $hotel = Hotel::findOrfail(session('hotel.id'));

        $rooms = $hotel->rooms()->inRandomOrder()->take(6)->get();

        $footers = $hotel->footers;

        $headers = $hotel->headers;

        return view('frontend.pages.rooms', compact('rooms',  'footers', 'headers'));
    }

    public function room($id){

        $room = Room::findOrfail($id);

        $hotel = Hotel::findOrfail(session('hotel.id'));

        $footers = $hotel->footers;

        $headers = $hotel->headers;

        return view('frontend.pages.room', compact('room', 'footers', 'headers'));
    }

    public function change(){

    }

    public function cancel_choice(){

    }

}