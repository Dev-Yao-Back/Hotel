<?php

namespace App\Http\Controllers;


use App\Models\Categorie_depense;
use App\Models\Compte;
use App\Models\Depense;
use App\Models\Hotel;
use Illuminate\Http\Request;

class DepenseController extends Controller
{
    public function index(){
        $hotels = Hotel::all();
        $comptes = Compte::all();
        $categorie_depenses = Categorie_depense::all();
        $depenses = Depense::with(['hotel', 'compte','categorie_depense'])->get();

        return view('backoffice.pages.depense.index', compact('hotels', 'comptes','categorie_depenses','depenses'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'compte_id' => 'required|exists:comptes,id',
            'categorie_depense_id' => 'required|exists:categorie_depenses,id',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string',
        ]);

        Depense::create($request->all());

        return redirect()->route('depense.index')->with('success', 'Dépense enregistrée avec succès.');
    }


}