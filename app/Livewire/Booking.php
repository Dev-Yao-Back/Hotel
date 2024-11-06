<?php

namespace App\Livewire;
use App\Models\Pricing;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class Booking extends Component
{
    public $pricing;
    public $room_id;
    public $pricings;
    public $rooms;
    public $bookings;

    protected $rules = [
        'nom_famille' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'genre' => 'required|string|max:255',
        'telephone' => 'required|string|max:20',
        'email' => 'nullable|email|max:255',
        'adresse' => 'nullable|string|max:255',
        'check_in_date' => 'required|date',
        'pricing_id' => 'required|integer',
    ];

    public function mount()
    {
        $this->pricings = Pricing::all();
        $this->rooms = Room::all();
        $this->bookings = Booking::all();
    }

    // Function Front Store

    public function front_store(Request $request)
    {
        // Validation des données
        $request->validate([
            'nom_famille' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'check_in_date' => 'required|date',
            'room_id' => 'required',
        ]);

        $pricing = Pricing::find($request->pricing_id);
        $checkInDate = Carbon::parse($request->check_in_date);
        $checkOutDate = $checkInDate->copy()->addHours($request->duration);
        $checkOutTime = Carbon::parse($pricing->duration);
        $checkOutDate->setTime($checkOutTime->hour, $checkOutTime->minute, $checkOutTime->second);

        $totalPrice = $pricing->price;

        // Récupérer toutes les chambres disponibles
        $availableRooms = Room::where('status', 'Disponible')
            ->whereDoesntHave('bookings', function ($query) use ($checkInDate, $checkOutDate) {
                $query->where(function ($query) use ($checkInDate, $checkOutDate) {
                    $query->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
                        ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate])
                        ->orWhere(function ($query) use ($checkInDate, $checkOutDate) {
                            $query->where('check_in_date', '<=', $checkInDate)
                                ->where('check_out_date', '>=', $checkOutDate);
                        });
                });
            })
            ->get();
        $status = $this->isRoomAvailable($checkInDate, $checkOutDate) ? 'Reservé' : 'En Attente';
        // Condition Available Rooms
        if ($availableRooms->isEmpty()) {
            // Pas de chambres disponibles, la réservation est mise en attente
            \App\Models\Booking::create([
                'user_id' => 1, // ID de l'utilisateur authentifié
                'room_id' => null, // Pas de chambre attribuée
                'nom_famille' => $request->nom_famille,
                'prenom' => $request->prenom,
                'genre' => $request->genre,
                'telephone' => $request->telephone,
                'email' => $request->email,
                'adresse' => $request->adresse,
                'check_in_date' => $checkInDate,
                'check_out_date' => $checkOutDate,
                'total_price' => $totalPrice,
                'payment_status' => 'Pending',
                'status' => $status,
            ]);

            return redirect()->route('booking.back_index')->with('success', 'Réservation mise en attente.');
        } else {
            // Assigner la première chambre disponible
            $room = $availableRooms->first();
            \App\Models\Booking::create([
                'user_id' => 1,
                'room_id' => $room->id,
                'nom_famille' => $request->nom_famille,
                'prenom' => $request->prenom,
                'genre' => $request->genre,
                'telephone' => $request->telephone,
                'email' => $request->email,
                'adresse' => $request->adresse,
                'check_in_date' => $checkInDate,
                'check_out_date' => $checkOutDate,
                'total_price' => $totalPrice,
                'payment_status' => 'Pending',
                'status' => $status,
            ]);
        }

        // Mettre à jour le statut de la chambre
        $room->update(['status' => 'Reservé']);
        $this->resetFields();
        return redirect()->route('booking.back_index')->with('success', 'Réservation créée avec succès.');
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'nom_famille' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string|max:255',
            'check_in_date' => 'required|date',
            'pricing_id' => 'required|integer',
        ]);

        // Récupérer l'ID de l'hôtel depuis la session
        $hotelId = session('hotel.id');
        if (!$hotelId) {
            return redirect()->back()->with('error', 'ID de l\'hôtel non trouvé.');
        }

        // Récupérer les informations de pricing
        $pricing = Pricing::findOrFail($request->pricing_id);
        $typeId = $pricing->id; // Assumer que `type_id` est le bon champ à utiliser
        $totalPrice = $pricing->price;
        $duration = $pricing->duration; // Assumer que `duration` est en jours

        // Calculer la date de départ
        $checkInDate = Carbon::parse($request->check_in_date);
        $checkOutDate = $checkInDate->copy()->addHours($duration);

        // Récupérer toutes les chambres disponibles pour l'hôtel et le type de chambre
        $availableRooms = Room::where('hotel_id', $hotelId)
            ->where('status', 'Disponible')
            ->whereHas('type_rooms', function ($query) use ($typeId) {
                $query->where('id', $typeId);
            })->get();

        // Parcourir les chambres disponibles pour trouver la première qui est réellement disponible
        foreach ($availableRooms as $room) {
            if ($status = $this->isRoomAvailable($room->id, $checkInDate, $checkOutDate) ? 'Réservé' : 'En Attente') {
                // Si une chambre est disponible, créer la réservation
                \App\Models\Booking::create([
                    'user_id' => 1, // ID de l'utilisateur authentifié
                    'room_id' => $room->id,
                    'nom_famille' => $request->nom_famille,
                    'prenom' => $request->prenom,
                    'genre' => $request->genre,
                    'telephone' => $request->telephone,
                    'email' => $request->email,
                    'adresse' => $request->adresse,
                    'check_in_date' => $checkInDate,
                    'check_out_date' => $checkOutDate,
                    'total_price' => $totalPrice,
                    'payment_status' => 'Pending',
                    'status' => $status,
                ]);

                // Mettre à jour le statut de la chambre
                $room->update(['status' => $status]);
                $this->resetFields();
                return redirect()->route('booking.back_index')->with('success', 'Réservation créée avec succès.');
            }
        }

        // Si aucune chambre n'est disponible
        return redirect()->back()->with('error', 'Aucune chambre disponible pour le type de chambre spécifié.');
    }

    public function index()
    {
        // Récupérer toutes les réservations
        $bookings = \App\Models\Booking::with(['user', 'room'])->get();

        return view('bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        // Récupérer une réservation spécifique
        $booking = \App\Models\Booking::with(['user', 'room'])->findOrFail($id);

        return view('bookings.show', compact('booking'));
    }

    public function edit($id)
    {
        // Récupérer la réservation pour l'édition
        $booking = \App\Models\Booking::findOrFail($id);
        $pricings = Pricing::with('roomType')->get();

        return view('bookings.edit', compact('booking', 'typeRooms', 'pricings'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'room_type_id' => 'required|exists:type_rooms,id',
            'pricing_id' => 'required|exists:pricings,id',
            'prenom' => 'required|string|max:255',
            'nom_famille' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'adresse' => 'required|string|max:255',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after_or_equal:check_in_date',
            'total_people' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        $booking = \App\Models\Booking::findOrFail($id);
        $pricing = Pricing::findOrFail($request->pricing_id);

        $checkInDate = Carbon::parse($request->check_in_date);
        $checkOutDate = Carbon::parse($request->check_out_date);
        $totalPrice = $pricing->price * $checkInDate->diffInDays($checkOutDate);

        // Récupérer les chambres disponibles
        $availableRooms = Room::where('status', 'Disponible')->get();

        foreach ($availableRooms as $room) {

            if ($status = $this->isRoomAvailable($room->id, $checkInDate, $checkOutDate) ? 'Reservé' : 'En Attente') {
                $booking->update([
                    'room_id' => $room->id,
                    'nom_famille' => $request->nom_famille,
                    'prenom' => $request->prenom,
                    'genre' => $request->genre,
                    'telephone' => $request->telephone,
                    'email' => $request->email,
                    'adresse' => $request->adresse,
                    'check_in_date' => $checkInDate,
                    'check_out_date' => $checkOutDate,
                    'total_price' => $totalPrice,
                    'payment_status' => 'Pending',
                    'status' => $status,
                ]);

                // Mettre à jour le statut de la chambre
                $room->update(['status' => $status]);
                $this->resetFields();
                return redirect()->route('booking.back_index')->with('success', 'Réservation mise à jour avec succès.');
            }
        }

        return redirect()->back()->with('error', 'Aucune chambre disponible pour la période sélectionnée.');
    }

    public function isRoomAvailable($roomId, $checkInDate, $checkOutDate)
    {
        return !\App\Models\Booking::where('room_id', $roomId)
            ->where(function ($query) use ($checkInDate, $checkOutDate) {
                $query->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
                    ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate])
                    ->orWhere(function ($query) use ($checkInDate, $checkOutDate) {
                        $query->where('check_in_date', '<=', $checkInDate)
                            ->where('check_out_date', '>=', $checkOutDate);
                    });
            })->exists();
    }

    public function destroy($id)
    {
        // Supprimer une réservation
        $booking = \App\Models\Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Réservation supprimée avec succès.');
    }

    public function resetFields()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.booking', [
            'rooms' => $this->rooms,
            'bookings' => $this->bookings,
            'pricings' => $this->pricings,
        ]
        );
    }
}
