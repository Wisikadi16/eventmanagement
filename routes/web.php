<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TicketTypeController; 
use App\Http\Controllers\CheckInController; 
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;


// =================================================================
// ✅ RUTE WEBHOOK MIDTRANS (HARUS PUBLIK DAN DI LUAR MIDDLEWARE)
// =================================================================
Route::post('/midtrans/notification', [BookingController::class, 'notificationHandler'])->name('midtrans.notification');


// -----------------------------------------------------------------
// RUTE UMUM (Welcome Page)
// -----------------------------------------------------------------
Route::get('/', function () {
    return view('welcome');
});

// Rute Dashboard (Akses setelah Login dan Verifikasi Email)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// =================================================================
// RUTE UTAMA (Membutuhkan Autentikasi)
// =================================================================
Route::middleware('auth')->group(function () {
    
    // -------------------------------------------------------------
    // RUTE PROFILE
    // -------------------------------------------------------------
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); 
    
    // -------------------------------------------------------------
    // RUTE EVENT (CRUD Lengkap)
    // -------------------------------------------------------------
    
    // Read (List)
    Route::get('/events', [EventController::class, 'index'])
        ->name('events.index')
        ->middleware('permission:view_event'); 

    // Create (Form)
    Route::get('/events/create', [EventController::class, 'create'])
        ->name('events.create')
        ->middleware('permission:create_event'); 

    // Create (Logic)
    Route::post('/events', [EventController::class, 'store'])
        ->name('events.store')
        ->middleware('permission:create_event');
    
    // Read (Single)
    Route::get('/events/{event}', [EventController::class, 'show'])
        ->name('events.show')
        ->middleware('permission:view_event');

    // Update (Form) - Otorisasi via Policy
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])
        ->name('events.edit'); 
    
    // Update (Logic) - Otorisasi via Policy
    Route::patch('/events/{event}', [EventController::class, 'update'])
        ->name('events.update');
        
    // Delete (Logic)
    Route::delete('/events/{event}', [EventController::class, 'destroy'])
        ->name('events.destroy')
        ->middleware('permission:delete_event');
    
    // =============================================================
    // RUTE PENGATURAN TIPE TIKET (NESTED RESOURCE)
    // =============================================================
    Route::resource('events.tickets', TicketTypeController::class)
        ->except(['show', 'create', 'edit'])
        ->middleware('permission:edit_event'); 

    // -------------------------------------------------------------
    // RUTE BOOKING (Untuk Attendee)
    // -------------------------------------------------------------
    
    // Daftar riwayat booking attendee
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    
    // 1. Proses Initial Booking (dari form Beli Sekarang)
    Route::post('/events/{event}/buy', [BookingController::class, 'store'])->name('bookings.store');

    // 2. Halaman Checkout/Pilih Pembayaran (GET)
    Route::get('/bookings/{booking}/checkout', [BookingController::class, 'showCheckout'])->name('bookings.checkout'); 

    // 3. Konfirmasi/Tiket Jadi (Setelah Pembayaran Sukses)
    Route::get('/bookings/{booking}/confirmation', [BookingController::class, 'showConfirmation'])->name('bookings.confirmation');

    Route::get('/bookings/{booking}', [BookingController::class, 'showTicketDetail'])->name('bookings.show');

    // =============================================================
    // RUTE CHECK-IN EVENT (FOR ORGANIZER)
    // =============================================================
    Route::prefix('events/{event}')->name('events.checkin.')->group(function () {
        
        // 1. Daftar Peserta (List Tickets) - Method index di CheckInController
        Route::get('attendees', [CheckInController::class, 'index']) 
            ->name('index')
            ->middleware('permission:edit_event'); 

        // 2. Halaman Scanner (Form Input QR Code) - Method showScanner di CheckInController
        Route::get('scanner', [CheckInController::class, 'showScanner']) 
            ->name('scanner')
            ->middleware('permission:edit_event');

        // 3. Proses Check-In (API Endpoint) - Method processCheckIn di CheckInController
        Route::post('check-in', [CheckInController::class, 'processCheckIn']) 
            ->name('process')
            ->middleware('permission:edit_event');
    });

    // =============================================================
    // RUTE REVIEWS EVENT (FOR ATTENDEE)
    // =============================================================
    Route::post('events/{event}/reviews', [ReviewController::class, 'store'])
        ->name('events.reviews.store')
        ->middleware('permission:review_event');

    // -------------------------------------------------------------
    // RUTE ADMIN AREA (DILINDUNGI OLEH PERMISSION ADMIN)
    // -------------------------------------------------------------
    Route::prefix('admin')->name('admin.')->middleware('permission:manage_users')->group(function () {
        
        // Admin Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        
        // RUTE BARU: Manajemen Pengguna (Menggunakan UserController)
        Route::resource('users', UserController::class)->only(['index', 'edit', 'update', 'destroy']);
    });
    
}); // <-- PENUTUP GRUP MIDDLEWARE('auth')

require __DIR__.'/auth.php';