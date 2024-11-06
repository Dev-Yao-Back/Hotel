<?php

namespace App\Http\Controllers;

use App\Models\EventSection;
use Illuminate\Http\Request;

class EventSectionController extends Controller
{
    public function index()
    {
        $eventSection = EventSection::where('hotel_id', session('hotel.id'))->first();

        return view('backoffice.pages.hotels.details.section.event', compact('eventSection'));
    }

    public function store(Request $request)
    {
        // Récupérer l'ID de l'hôtel de la session
        $hotelId = session('hotel.id');

        // Vérifier si l'hôtel a déjà une section d'événement
        $eventSection = EventSection::where('hotel_id', $hotelId)->first();

        // Définir les règles de validation
        $rules = [
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'event_title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_description' => 'required|string',
        ];

        // Valider les données d'entrée
        $request->validate($rules);

        if ($eventSection) {
            // Si une section d'événement existe, mettez à jour les informations
            $eventSection->update([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'event_title' => $request->event_title,
                'event_date' => $request->event_date,
                'event_description' => $request->event_description,
            ]);
        } else {
            // Sinon, créez une nouvelle section d'événement
            $eventSection = EventSection::create([
                'hotel_id' => $hotelId,
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'event_title' => $request->event_title,
                'event_date' => $request->event_date,
                'event_description' => $request->event_description,
            ]);
        }

        return redirect()->route('event-sections.index');
    }    public function show(EventSection $event)
    {
        return response()->json($event);
    }

    public function update(Request $request, EventSection $event)
    {
        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'event_title' => 'sometimes|required|string|max:255',
            'event_date' => 'sometimes|required|date',
            'event_description' => 'sometimes|required|string',
        ]);

        $event->update($data);

        return response()->json($event);
    }

    public function destroy(EventSection $event)
    {
        $event->delete();

        return response()->json(null, 204);
    }
}
