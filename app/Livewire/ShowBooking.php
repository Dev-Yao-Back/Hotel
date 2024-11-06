<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Pricing;
use App\Models\Room;
use Carbon\Carbon;
use Livewire\Component;

class ShowBooking extends Component
{
    public $bookings;
    public $rooms;
    public $statutsFilters = [
        'Réservé' => false,
        'Disponible' => false,
        'En Attente' => false,
    ];

    public function mount()
    {
        $this->loadBooking();
    }

    //BackOffice Functions
    public function back_index()
    {

        $pricings = Pricing::with('roomType')->get();
        $hotelId = session('hotel.id');

        // Récupérer l'hôtel avec ses chambres et les réservations associées
        $hotel = Hotel::with('rooms.bookings')->find($hotelId);

        // Initialiser un tableau pour stocker les réservations
        $bookings = [];

        // Parcourir les chambres et récupérer les réservations
        foreach ($hotel->rooms as $room) {
            foreach ($room->bookings as $booking) {
                $bookings[] = $booking;
            }
        }

        $hotelName = $hotel ? $hotel->uname : 'Hôtel Inconnu';

          
    return view('backoffice.pages.bookings.index', compact('pricings', 'bookings', 'hotelName'));;
    }

    public function render()
    {
        $this->rooms = Room::all();
        return view('backoffice.pages.bookings.index', [
            'bookings' => $this->bookings,
            'rooms' => $this->rooms,
        ]);
    }

    public function updateStatusFilters()
    {
        $this->loadBooking();
    }
    public function loadBooking()
    {
        $query = Booking::query();

        if ($this->statutsFilters['Réservé']) {
            $query->where('check_in_date', '<=', now())
                ->where('check_out_date', '>', now());
        } elseif ($this->statusFilters['Disponible']) {
            $query->where('check_out_date', '<=', now());
        } elseif ($this->statusFilters['En Attente']) {
            $query->where('check_in_date', '>', now());
        }

        if (!$this->statusFilters['Réservé'] && !$this->statusFilters['Disponible'] && !$this->statusFilters['En Attente']) {
            $this->bookings = Booking::all();
        } else {
            $this->bookings = $query->get();
        }
    }

    public function getRemainingTime($checkOutTime)
    {
        $now = Carbon::now();
        $checkOutTime = Carbon::parse($checkOutTime);
        return $checkOutTime->diffInSeconds($now);
    }

    public function refreshBookings()
    {
        $this->loadBookings();
    }
}