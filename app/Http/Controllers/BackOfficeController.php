<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Compte;
use App\Models\CategorieRevenu;
use App\Models\Revenu;
use App\Models\Pricing;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;


class BackOfficeController extends Controller
{
 
    public function index()
{
    // Récupérer tous les hôtels avec le nombre total de réservations associées
    $hotels = Hotel::withCount('bookings as total_bookings')->get();
    
    // Calculer le nombre total de réservations pour tous les hôtels
    $totalReservations = $hotels->sum('total_bookings');
    
    // Récupérer tous les hôtels avec les chambres associées
    $hotelsWithRooms = Hotel::with('rooms.type_rooms')->get();

 
// Calculer le nombre total de chambres disponibles
$totalAvailableRooms = $hotelsWithRooms->flatMap(function ($hotel) {
    return $hotel->rooms->filter(function ($room) {
        return $room->status === 'Disponible';
    });
})->count();

// Calculer le nombre total de chambres VIP disponibles
$totalAvailableVIPRooms = $hotelsWithRooms->flatMap(function ($hotel) {
    return $hotel->rooms->filter(function ($room) {
        // Assurez-vous que $room->type_rooms est bien un modèle TypeRoom et accédez à l'attribut 'uname'
        return $room->status === 'Disponible' && $room->type_rooms->uname === 'Chambre VIP';
    });
})->count();

$totalAvailableStandardRooms = $hotelsWithRooms->flatMap(function ($hotel) {
    return $hotel->rooms->filter(function ($room) {
        return $room->status === 'Disponible' && $room->type_rooms->uname === 'Chambre Standard';
    });
})->count();


// Calculer les pourcentages
$percentageReservations = $totalAvailableRooms > 0 ? ($totalReservations / $totalAvailableRooms)  : 100;
$percentageAvailableRooms = $totalAvailableRooms > 0 ? ($totalAvailableRooms / $totalAvailableRooms) :100 ;
$percentageVIPRooms = $totalAvailableRooms > 0 ? ($totalAvailableVIPRooms / $totalAvailableRooms) :100 ;
$percentageStandardRooms = $totalAvailableRooms > 0 ? ($totalAvailableStandardRooms / $totalAvailableRooms) :100 ;

// compte total //

$comptes = Compte::all();
$totalComptes = Compte::count(); 

// total dew depenses // 
$hotels = Hotel::all();
$comptes = Compte::all();
$categorie_revenus = CategorieRevenu::all();
$revenus = Revenu::with(['hotel', 'compte', 'categorie_revenu'])->get();

// Calcul des dépenses totales pour chaque hôtel
$depensesParHotel = [];
foreach ($hotels as $hotel) {
    $depensesParHotel[$hotel->id] = $hotel->depenses()->sum('amount'); // Remplace 'amount' par le nom correct de ta colonne
}


// total revenu // 

$hotels = Hotel::all();
$comptes = Compte::all();
$categorie_revenus = CategorieRevenu::all();

// Récupération des revenus avec les relations
$revenus = Revenu::with(['hotel', 'compte', 'categorie_revenu'])->get();

// Calcul du total des revenus pour chaque hôtel
$revenusParHotel = Revenu::select('hotel_id', DB::raw('SUM(amount) as total_revenu'))
    ->groupBy('hotel_id')
    ->get();


// gestion total des comptes //

// Initialiser un tableau pour stocker le total des comptes par hôtel
// Calcul des revenus totaux
$totalRevenu = $revenusParHotel->sum('total_revenu');

// Calcul des dépenses totales
$totalDepense = array_sum($depensesParHotel);

// Calcul de la somme totale des revenus et des dépenses
$nombretotalcomptes = $totalRevenu + $totalDepense;

// Passer la variable à la vue
return view('backoffice.index', compact('comptes', 'nombretotalcomptes', 'totalReservations', 'totalAvailableRooms', 'totalAvailableVIPRooms', 'totalAvailableStandardRooms', 'percentageReservations', 'percentageAvailableRooms', 'percentageVIPRooms', 'percentageStandardRooms', 'totalComptes', 'depensesParHotel', 'hotels', 'revenus', 'revenusParHotel'));


}





}
