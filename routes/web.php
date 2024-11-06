<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\hotelController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\testimonialController;
use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\ServicceController;
use App\Http\Controllers\RoomServiceController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\BackOfficeController;
use App\Http\Controllers\GroupHototelController;
use App\Http\Controllers\PricingController;



use App\Http\Controllers\HeroSectionController;
use App\Http\Controllers\DescriptionSectionController;
use App\Http\Controllers\RoomCarouselSectionController;
use App\Http\Controllers\ExtraSectionController;
use App\Http\Controllers\MessageSectionController;
use App\Http\Controllers\ServiceSectionController;
use App\Http\Controllers\EventSectionController;
use App\Http\Controllers\RestaurantSectionController;
use App\Http\Controllers\TestimonialSectionController;
use App\Http\Controllers\FooterSectionController;
use App\Http\Controllers\HeaderSectionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoomAvailabilityController;
use App\Livewire\Booking;
use App\Livewire\ShowBooking;
use App\Http\Controllers\RevenuController;
use App\Http\Controllers\ComptaController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\MapSectionController;

use App\Http\Middleware\CheckHotelSession;
use App\Http\Middleware\AuthenticateAndGenerateSession;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
return view('welcome');
});

Route::get('/dashboard', function () {
return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Gestion d'hotel


Route::get('/hotel', [hotelController::class, 'index'])->name('hotel.index');
Route::get('hotel/read', [hotelController::class, 'read'])->name('hotel.read');
Route::get('hotel/{hotel}/edit', [hotelController::class, 'edit'])->name('hotel.edit');
Route::put('hotel/{hotel}', [hotelController::class, 'update'])->name('hotel.update');
Route::delete('hotel/{hotel}', [hotelController::class, 'destroy'])->name('hotel.destroy');




Route::get('room/index', [RoomController::class, 'index'])->name('room.index');
Route::get('room/turn', [RoomController::class, 'turn'])->name('room.turn');
Route::post('room/index', [RoomController::class, 'create'])->name('room.create');
Route::get('room/read', [RoomController::class, 'show'])->name('room.show');
Route::delete('room/read/{id}', [RoomController::class, 'delete'])->name('room.supprimer');
Route::get('room/{id}/edit', [RoomController::class, 'edit'])->name('room.edit');
Route::put('room/{id}', [RoomController::class, 'update'])->name('room.update');
Route::get('room/search', [RoomController::class, 'search'])->name('rooms.search');


// gestion Media gallery

Route::get('media/create',[MediaController::class,'create'])->name('media.create');
Route::post('media', [MediaController::class, 'store'])->name('media.store');
Route::get('/media/{room_id}', [MediaController::class, 'show'])->name('media.show');





// Booking Livewire Component
Route::get('/booking/index', [Booking::class, 'create'])->name('booking.index');
Route::post('/booking/store', [Booking::class, 'store'])->name('booking.store');
Route::get('/booking/{id}', [Booking::class, 'show'])->name('booking.show');
Route::delete('booking/show/{id}', [Booking::class, 'delete'])->name('booking.supprimer');
Route::get('booking/{id}/edit', [Booking::class, 'edit'])->name('booking.edit');
Route::put('booking/{id}', [Booking::class, 'update'])->name('booking.update');

 // afficher tous les reservation effectuer//




// Gestion des articles de blogs

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('blog/ceate', [BlogController::class, 'create'])->name('blog.create');
Route::post('blog/ceate', [BlogController::class, 'store'])->name('blog.store');
Route::get('blog/read/{id}', [BlogController::class, 'read'])->name('blog.read');

// Gestions des temoignages

Route::resource('/testimonial', testimonialController::class);
Route::post('testimonial/{testimonial}/approve', [testimonialController::class, 'approve'])->name('testimonial.approve');
Route::post('testimonial/{testimonial}/reject', [testimonialController::class, 'reject'])->name('testimonial.reject');

// Gestion offre emploi

// partir job //

Route::get('/job_offers', [JobOfferController::class, 'index'])->name('job_offers.index');
Route::get('/job_offers/create', [JobOfferController::class, 'create'])->name('job_offers.create');
Route::post('/job_offers', [JobOfferController::class, 'store'])->name('job_offers.store');
Route::get('/job_offers/{jobOffer}', [JobOfferController::class, 'show'])->name('job_offers.show');
Route::get('/job_offers/{jobOffer}/edit', [JobOfferController::class, 'edit'])->name('job_offers.edit');
Route::put('/job_offers/{jobOffer}', [JobOfferController::class, 'update'])->name('job_offers.update');
Route::delete('/job_offers/{jobOffer}', [JobOfferController::class, 'destroy'])->name('job_offers.destroy');

// partir candidtature//


Route::get('/applications', [JobApplicationController::class, 'index'])->name('applications.index');
Route::get('/applications/{jobOffer}/create', [JobApplicationController::class, 'create'])->name('applications.create');
Route::post('/applications', [JobApplicationController::class, 'store'])->name('applications.store');
Route::get('/applications/{id}', [JobApplicationController::class, 'show'])->name('applications.show');
Route::delete('/applications/{id}', [JobApplicationController::class, 'destroy'])->name('applications.destroy');



// Gestion des services de chambres

Route::get('/service', [ServicceController::class, 'create'])->name('service.create');
Route::post('service/create', [ServicceController::class, 'store'])->name('service.store');
Route::get('roomservice/create', [RoomServiceController::class, 'create'])->name('roomservice.create');
Route::post('roomservice/create', [RoomServiceController::class, 'store'])->name('roomservice.store');
Route::get('roomservice/show', [RoomServiceController::class, 'show'])->name('roomservice.show');

//gestion des contact
Route::get('/contact',[ContactController::class,'index']);
Route::post('/contact/send',[ContactController::class,'SendMail'])->name('sendmail');;


//FRONT-END ROUTE

Route::get('/', [FrontEndController::class, 'index'])->name('frontend.index');
Route::get('/hotel/{id}/', [FrontEndController::class, 'choice'])->name('frontend.hotel_choice');

Route::middleware(['check.hotel.session'])->group(function(){
    Route::get('/hotel', [FrontEndController::class, 'hotel'])->name('frontend.hotel_index');
    Route::get('/about', [FrontEndController::class, 'about'])->name('frontend.hotel_about');
    Route::get('/roomss', [FrontEndController::class, 'rooms'])->name('frontend.hotel_rooms');
    Route::get('/room/{id}', [FrontEndController::class, 'room'])->name('frontend.hotel_room');
    Route::post('/room/store', [BookingController::class, 'front_store'])->name('frontend.room_booking');
    Route::get('/resto', [FrontEndController::class, 'resto'])->name('frontend.hotel_resto');
    Route::get('/job', [FrontEndController::class, 'job'])->name('frontend.hotel_job');
});

Route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login/store', [LoginController::class, 'login'])->name('admin.login.store');

// BACK-OFFICE ROUTE

Route::middleware(['auth.session.user'])->group(function(){
    Route::prefix('admin')->group(function(){

        Route::get('/', [BackOfficeController::class, 'index'])->name('back.dashbord');

        Route::get('/groupe_hotel', [GroupHototelController::class, 'back_index'])->name('groupe_hotel.back_index');
        Route::get('/groupe_hotel/deatils', [GroupHototelController::class, 'back_details'])->name('groupe_hotel.back_details');
        Route::post('/groupe_hotel', [GroupHototelController::class, 'create'])->name('groupe_hotel.create');

        Route::get('/hotel', [HotelController::class, 'back_index'])->name('hotel.back_index');
        Route::get('/hotel/details', [HotelController::class, 'back_details'])->name('hotel.back_details');
        Route::get('/hotel/detail/{id}', [HotelController::class, 'back_detail'])->name('hotel.back_detail');
        Route::get('/hotel/detail/{id}/save', [HotelController::class, 'detail_store'])->name('hotel.back_detail_store');
        Route::post('/hotel', [hotelController::class, 'create'])->name('hotel.create');

        Route::get('/room/type', [RoomController::class, 'back_type'])->name('room.back_type');
        Route::get('/room', [RoomController::class, 'back_index'])->name('room.back_index');
        Route::get('/room/type_create', [RoomController::class, 'type_create'])->name('room.type_create');
        Route::get('/room/create', [RoomController::class, 'create'])->name('room.back_create');
        Route::post('/room/create', [RoomController::class, 'create'])->name('room.back_create');
        Route::get('/room/{id}/edit', [RoomController::class, 'edit'])->name('room.back_edit');
        Route::put('/room/{id}/edit', [RoomController::class, 'update'])->name('room.back_update');
        Route::delete('/room/{id}', [RoomController::class, 'destroy'])->name('room.destroy');


        Route::get('hotel/booking/', [BookingController::class, 'choice'])->name('booking.choice');
        Route::get('hotel/{id}/booking/', [BookingController::class, 'choice_hotel'])->name('booking.choice_hotel');
        Route::get('/booking', [BookingController::class, 'back_index'])->name('booking.back_index');
        Route::get('booking/{id}/add', [BookingController::class, 'edit'])->name('booking.edit');

         // ShowBooking Livewire Component
         Route::get('/booking', [ShowBooking::class, 'back_index'])->name('booking.back_index');

        Route::post('/booking/store', [Booking::class, 'store'])->name('booking.back_store');
        Route::put('/booking/{id}', [BookingController::class, 'update'])->name('booking.back_update');
        Route::delete('booking/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');




        //Route comptabilite

        Route::get('hotel/comptabilite', [ComptaController::class, 'choice'])->name('compta.detail');
        Route::post('comptabilite/detail/', [ComptaController::class, 'create'])->name('compta.create');



        //Route revenu

        Route::get('revenu/index', [RevenuController::class, 'index'])->name('revenu.index');
        Route::post('', [RevenuController::class, 'store'])->name('revenu.store');



        //Route depense

        Route::get('depense/index', [DepenseController::class, 'index'])->name('depense.index');
        Route::post('depense', [DepenseController::class, 'store'])->name('depense.store');

         //Route Transfert

         Route::get('transfert/index', [TransactionController::class, 'index'])->name('transfert.index');
         Route::post('depense/index', [TransactionController::class, 'create'])->name('transfert.create');








        Route::get('pricings', [PricingController::class, 'index'])->name('pricings.index');
        Route::get('pricings/create', [PricingController::class, 'create'])->name('pricings.create');
        Route::post('pricings', [PricingController::class, 'store'])->name('pricings.store');
        Route::get('pricings/{pricing}', [PricingController::class, 'show'])->name('pricings.show');
        Route::get('pricings/{pricing}/edit', [PricingController::class, 'edit'])->name('pricings.edit');
        Route::put('pricings/{pricing}', [PricingController::class, 'update'])->name('pricings.update');
        Route::delete('pricings/{pricing}', [PricingController::class, 'destroy'])->name('pricings.destroy');

        // route admin filtrage //

        Route::get('/Filtrage/filtre', [RoomAvailabilityController::class, 'back_index'])->name('filtrage.filtre');


        Route::prefix('/hotel')->group(function () {

          //maps sections




            // Hero Section
            Route::get('hero-sections', [HeroSectionController::class, 'index'])->name('hero-sections.index');
            Route::get('hero-sections/create', [HeroSectionController::class, 'create'])->name('hero-sections.create');
            Route::post('hero-sections', [HeroSectionController::class, 'store'])->name('hero-sections.store');
            Route::get('hero-sections/{heroSection}', [HeroSectionController::class, 'show'])->name('hero-sections.show');
            Route::get('hero-sections/{heroSection}/edit', [HeroSectionController::class, 'edit'])->name('hero-sections.edit');
            Route::put('hero-sections/{heroSection}', [HeroSectionController::class, 'update'])->name('hero-sections.update');
            Route::delete('hero-sections/{heroSection}', [HeroSectionController::class, 'destroy'])->name('hero-sections.destroy');

            // Description Section
            Route::get('description-sections', [DescriptionSectionController::class, 'index'])->name('description-sections.index');
            Route::get('description-sections/create', [DescriptionSectionController::class, 'create'])->name('description-sections.create');
            Route::post('description-sections', [DescriptionSectionController::class, 'store'])->name('description-sections.store');
            Route::get('description-sections/{descriptionSection}', [DescriptionSectionController::class, 'show'])->name('description-sections.show');
            Route::get('description-sections/{descriptionSection}/edit', [DescriptionSectionController::class, 'edit'])->name('description-sections.edit');
            Route::put('description-sections/{descriptionSection}', [DescriptionSectionController::class, 'update'])->name('description-sections.update');
            Route::delete('description-sections/{descriptionSection}', [DescriptionSectionController::class, 'destroy'])->name('description-sections.destroy');

            // Room Carousel Section
            Route::get('room-carousel-sections', [RoomCarouselSectionController::class, 'index'])->name('room-carousel-sections.index');
            Route::get('room-carousel-sections/create', [RoomCarouselSectionController::class, 'create'])->name('room-carousel-sections.create');
            Route::post('room-carousel-sections', [RoomCarouselSectionController::class, 'store'])->name('room-carousel-sections.store');
            Route::get('room-carousel-sections/{roomCarouselSection}', [RoomCarouselSectionController::class, 'show'])->name('room-carousel-sections.show');
            Route::get('room-carousel-sections/{roomCarouselSection}/edit', [RoomCarouselSectionController::class, 'edit'])->name('room-carousel-sections.edit');
            Route::put('room-carousel-sections/{roomCarouselSection}', [RoomCarouselSectionController::class, 'update'])->name('room-carousel-sections.update');
            Route::delete('room-carousel-sections/{roomCarouselSection}', [RoomCarouselSectionController::class, 'destroy'])->name('room-carousel-sections.destroy');

            // Extra Section
            Route::get('extra-sections', [ExtraSectionController::class, 'index'])->name('extra-sections.index');
            Route::get('extra-sections/create', [ExtraSectionController::class, 'create'])->name('extra-sections.create');
            Route::post('extra-sections', [ExtraSectionController::class, 'store'])->name('extra-sections.store');
            Route::get('extra-sections/{extraSection}', [ExtraSectionController::class, 'show'])->name('extra-sections.show');
            Route::get('extra-sections/{extraSection}/edit', [ExtraSectionController::class, 'edit'])->name('extra-sections.edit');
            Route::put('extra-sections/{extraSection}', [ExtraSectionController::class, 'update'])->name('extra-sections.update');
            Route::delete('extra-sections/{extraSection}', [ExtraSectionController::class, 'destroy'])->name('extra-sections.destroy');

            // Message Section
            Route::get('message-sections', [MessageSectionController::class, 'index'])->name('message-sections.index');
            Route::get('message-sections/create', [MessageSectionController::class, 'create'])->name('message-sections.create');
            Route::post('message-sections', [MessageSectionController::class, 'store'])->name('message-sections.store');
            Route::get('message-sections/{messageSection}', [MessageSectionController::class, 'show'])->name('message-sections.show');
            Route::get('message-sections/{messageSection}/edit', [MessageSectionController::class, 'edit'])->name('message-sections.edit');
            Route::put('message-sections/{messageSection}', [MessageSectionController::class, 'update'])->name('message-sections.update');
            Route::delete('message-sections/{messageSection}', [MessageSectionController::class, 'destroy'])->name('message-sections.destroy');

            // Service Section
            Route::get('service-sections', [ServiceSectionController::class, 'index'])->name('service-sections.index');
            Route::get('service-sections/create', [ServiceSectionController::class, 'create'])->name('service-sections.create');
            Route::post('service-sections', [ServiceSectionController::class, 'store'])->name('service-sections.store');
            Route::get('service-sections/{serviceSection}', [ServiceSectionController::class, 'show'])->name('service-sections.show');
            Route::get('service-sections/{serviceSection}/edit', [ServiceSectionController::class, 'edit'])->name('service-sections.edit');
            Route::put('service-sections/{serviceSection}', [ServiceSectionController::class, 'update'])->name('service-sections.update');
            Route::delete('service-sections/{serviceSection}', [ServiceSectionController::class, 'destroy'])->name('service-sections.destroy');

            // Event Section
            Route::get('event-sections', [EventSectionController::class, 'index'])->name('event-sections.index');
            Route::get('event-sections/create', [EventSectionController::class, 'create'])->name('event-sections.create');
            Route::post('event-sections', [EventSectionController::class, 'store'])->name('event-sections.store');
            Route::get('event-sections/{eventSection}', [EventSectionController::class, 'show'])->name('event-sections.show');
            Route::get('event-sections/{eventSection}/edit', [EventSectionController::class, 'edit'])->name('event-sections.edit');
            Route::put('event-sections/{eventSection}', [EventSectionController::class, 'update'])->name('event-sections.update');
            Route::delete('event-sections/{eventSection}', [EventSectionController::class, 'destroy'])->name('event-sections.destroy');

            // Restaurant Section
            Route::get('restaurant-sections', [RestaurantSectionController::class, 'index'])->name('restaurant-sections.index');
            Route::get('restaurant-sections/create', [RestaurantSectionController::class, 'create'])->name('restaurant-sections.create');
            Route::post('restaurant-sections', [RestaurantSectionController::class, 'store'])->name('restaurant-sections.store');
            Route::get('restaurant-sections/{restaurantSection}', [RestaurantSectionController::class, 'show'])->name('restaurant-sections.show');
            Route::get('restaurant-sections/{restaurantSection}/edit', [RestaurantSectionController::class, 'edit'])->name('restaurant-sections.edit');
            Route::put('restaurant-sections/{restaurantSection}', [RestaurantSectionController::class, 'update'])->name('restaurant-sections.update');
            Route::delete('restaurant-sections/{restaurantSection}', [RestaurantSectionController::class, 'destroy'])->name('restaurant-sections.destroy');

            // Testimonial Section
            Route::get('testimonial-sections', [TestimonialSectionController::class, 'index'])->name('testimonial-sections.index');
            Route::get('testimonial-sections/create', [TestimonialSectionController::class, 'create'])->name('testimonial-sections.create');
            Route::post('testimonial-sections', [TestimonialSectionController::class, 'store'])->name('testimonial-sections.store');
            Route::get('testimonial-sections/{testimonialSection}', [TestimonialSectionController::class, 'show'])->name('testimonial-sections.show');
            Route::get('testimonial-sections/{testimonialSection}/edit', [TestimonialSectionController::class, 'edit'])->name('testimonial-sections.edit');
            Route::put('testimonial-sections/{testimonialSection}', [TestimonialSectionController::class, 'update'])->name('testimonial-sections.update');
            Route::delete('testimonial-sections/{testimonialSection}', [TestimonialSectionController::class, 'destroy'])->name('testimonial-sections.destroy');

            // Footer Section
            Route::get('footer-sections', [FooterSectionController::class, 'index'])->name('footer-sections.index');
            Route::get('footer-sections/create', [FooterSectionController::class, 'create'])->name('footer-sections.create');
            Route::post('footer-sections', [FooterSectionController::class, 'store'])->name('footer-sections.store');
            Route::get('footer-sections/{footerSection}', [FooterSectionController::class, 'show'])->name('footer-sections.show');
            Route::get('footer-sections/{footerSection}/edit', [FooterSectionController::class, 'edit'])->name('footer-sections.edit');
            Route::put('footer-sections/{footerSection}', [FooterSectionController::class, 'update'])->name('footer-sections.update');
            Route::delete('footer-sections/{footerSection}', [FooterSectionController::class, 'destroy'])->name('footer-sections.destroy');

            // Header Section
            Route::get('header-sections', [HeaderSectionController::class, 'index'])->name('header-sections.index');
            Route::get('header-sections/create', [HeaderSectionController::class, 'create'])->name('header-sections.create');
            Route::post('header-sections', [HeaderSectionController::class, 'store'])->name('header-sections.store');
            Route::get('header-sections/{headerSection}', [HeaderSectionController::class, 'show'])->name('header-sections.show');
            Route::get('header-sections/{headerSection}/edit', [HeaderSectionController::class, 'edit'])->name('header-sections.edit');
            Route::put('header-sections/{headerSection}', [HeaderSectionController::class, 'update'])->name('header-sections.update');
            Route::delete('header-sections/{headerSection}', [HeaderSectionController::class, 'destroy'])->name('header-sections.destroy');

            // Map Section
            Route::get('map-sections', [MapSectionController::class, 'index'])->name('map-sections.index');
            Route::get('map-sections/create', [MapSectionController::class, 'create'])->name('map-sections.create');
            Route::post('map-sections', [MapSectionController::class, 'store'])->name('map-sections.store');
            Route::get('map-sections/{mapSection}', [MapSectionController::class, 'show'])->name('map-sections.show');
            Route::get('map-sections/{mapSection}/edit', [MapSectionController::class, 'edit'])->name('map-sections.edit');
            Route::put('map-sections/{mapSection}', [MapSectionController::class, 'update'])->name('map-sections.update');
            Route::delete('map-sections/{mapSection}', [MapSectionController::class, 'destroy'])->name('map-sections.destroy');
            });
    });
});



require __DIR__.'/auth.php';
