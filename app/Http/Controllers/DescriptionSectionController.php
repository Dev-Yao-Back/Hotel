<?php

namespace App\Http\Controllers;

use App\Models\DescriptionSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DescriptionSectionController extends Controller
{
    public function index()
    {
        $descriptionSection = DescriptionSection::where('hotel_id', session('hotel.id'))->first();

        return view('backoffice.pages.hotels.details.section.description', compact('descriptionSection'));
    }

    public function store(Request $request)
    {
        // Récupérer l'ID de l'hôtel de la session
        $hotelId = session('hotel.id');

        // Vérifier si l'hôtel a déjà une section de description
        $description = DescriptionSection::where('hotel_id', $hotelId)->first();

        // Définir les règles de validation
        $rules = [
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'required|string',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|url',
        ];

        // Ajouter la validation des images
        if (!$description) {
            $rules['image_1'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            $rules['image_2'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            $rules['image_3'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        } else {
            $rules['image_1'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            $rules['image_2'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            $rules['image_3'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        // Valider les données d'entrée
        $request->validate($rules);

        // Stocker les images si elles sont présentes
        $image1Path = $description ? $description->image_1 : null;
        $image2Path = $description ? $description->image_2 : null;
        $image3Path = $description ? $description->image_3 : null;

        if ($request->hasFile('image_1')) {
            $image1Path = $request->file('image_1')->move(public_path('descriptions'), $request->file('image_1')->getClientOriginalName());
            $image1Path = 'descriptions/' . $request->file('image_1')->getClientOriginalName();
        }

        if ($request->hasFile('image_2')) {
            $image2Path = $request->file('image_2')->move(public_path('descriptions'), $request->file('image_2')->getClientOriginalName());
            $image2Path = 'descriptions/' . $request->file('image_2')->getClientOriginalName();
        }

        if ($request->hasFile('image_3')) {
            $image3Path = $request->file('image_3')->move(public_path('descriptions'), $request->file('image_3')->getClientOriginalName());
            $image3Path = 'descriptions/' . $request->file('image_3')->getClientOriginalName();
        }

        if ($description) {
            // Si une section de description existe, mettez à jour les informations
            $description->update([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'content' => $request->content,
                'button_text' => $request->button_text,
                'button_link' => $request->button_link,
                'image_1' => $image1Path,
                'image_2' => $image2Path,
                'image_3' => $image3Path,
            ]);
        } else {
            // Sinon, créez une nouvelle section de description
            $description = DescriptionSection::create([
                'hotel_id' => $hotelId,
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'content' => $request->content,
                'button_text' => $request->button_text,
                'button_link' => $request->button_link,
                'image_1' => $image1Path,
                'image_2' => $image2Path,
                'image_3' => $image3Path,
            ]);
        }

        return redirect()->route('description-sections.index');
    }

    public function show(DescriptionSection $description)
    {
        return response()->json($description);
    }

    public function update(Request $request, DescriptionSection $description)
    {
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'required|string',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|url',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image_1')) {
            Storage::delete($description->image_1);
            $description->image_1 = $request->file('image_1')->store('descriptions');
        }

        if ($request->hasFile('image_2')) {
            Storage::delete($description->image_2);
            $description->image_2 = $request->file('image_2')->store('descriptions');
        }

        if ($request->hasFile('image_3')) {
            Storage::delete($description->image_3);
            $description->image_3 = $request->file('image_3')->store('descriptions');
        }

        $description->update($request->only('title', 'subtitle', 'content', 'button_text', 'button_link'));

        return response()->json($description);
    }

    public function destroy(DescriptionSection $description)
    {
        Storage::delete($description->image_1);
        Storage::delete($description->image_2);
        Storage::delete($description->image_3);
        $description->delete();

        return response()->json(null, 204);
    }
}



