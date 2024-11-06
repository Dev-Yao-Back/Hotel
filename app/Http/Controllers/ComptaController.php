<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use Illuminate\Http\Request;
use App\Models\Hotel;

class ComptaController extends Controller
{
    public function choice(){

        $hotels = Hotel::all();
        $comptes = Compte::all();
        

        return view('backoffice.pages.comptabilite.index', compact('hotels', 'comptes'));
    }
    public function create(Request $request){

        $data=$request->validate([
            'compte_number'=>'required',
            'compte_name'=>'required',
            'solde'=>'required',
            'description'=>'',
        ]);
        Compte::create($data);

        return redirect()->route('compta.detail');

    }
}