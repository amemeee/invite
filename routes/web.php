<?php

use App\Http\Controllers\ProfileController;
use App\Models\Card;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/i/{token}',        [\App\Http\Controllers\CardController::class,           'invite'])->name('cards.invite');
Route::post('/i/{token}/rsvp',  [\App\Http\Controllers\CardFeatureController::class,   'storeRsvp'])->name('cards.rsvp.store');
Route::post('/i/{token}/wish',  [\App\Http\Controllers\CardFeatureController::class,   'storeWish'])->name('cards.wish.store');
Route::post('/i/{token}/submit',[\App\Http\Controllers\CardSubmissionController::class,'store'])->name('cards.submit');

Route::get('/dashboard', function () {
    $totalCards = Card::where('user_id', auth()->id())->count();
    $thisMonth  = Card::where('user_id', auth()->id())
                    ->whereMonth('created_at', now()->month)
                    ->count();
    $recentCards = Card::where('user_id', auth()->id())
                    ->latest()
                    ->take(5)
                    ->get();

    return view('dashboard', compact('totalCards', 'thisMonth', 'recentCards'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('cards', \App\Http\Controllers\CardController::class);

    // Custom fields + responses
    Route::prefix('cards/{card}')->name('cards.')->group(function () {
        Route::post('/fields',              [\App\Http\Controllers\CardFieldController::class,      'store'])->name('fields.store');
        Route::delete('/fields/{field}',    [\App\Http\Controllers\CardFieldController::class,      'destroy'])->name('fields.destroy');
        Route::post('/fields/{field}/up',   [\App\Http\Controllers\CardFieldController::class,      'moveUp'])->name('fields.up');
        Route::post('/fields/{field}/down', [\App\Http\Controllers\CardFieldController::class,      'moveDown'])->name('fields.down');
        Route::get('/responses',            [\App\Http\Controllers\CardSubmissionController::class, 'index'])->name('responses');
        Route::get('/responses/export',     [\App\Http\Controllers\CardSubmissionController::class, 'export'])->name('responses.export');
    });

    // Feature management
    Route::prefix('cards/{card}')->name('cards.')->group(function () {
        Route::get('/manage',             [\App\Http\Controllers\CardFeatureController::class, 'manage'])->name('manage');
        Route::post('/countdown',         [\App\Http\Controllers\CardFeatureController::class, 'storeCountdown'])->name('countdown.store');
        Route::delete('/countdown',       [\App\Http\Controllers\CardFeatureController::class, 'destroyCountdown'])->name('countdown.destroy');
        Route::post('/location',          [\App\Http\Controllers\CardFeatureController::class, 'storeLocation'])->name('location.store');
        Route::delete('/location',        [\App\Http\Controllers\CardFeatureController::class, 'destroyLocation'])->name('location.destroy');
        Route::post('/music',             [\App\Http\Controllers\CardFeatureController::class, 'storeMusic'])->name('music.store');
        Route::delete('/music',           [\App\Http\Controllers\CardFeatureController::class, 'destroyMusic'])->name('music.destroy');
        Route::post('/gallery',           [\App\Http\Controllers\CardFeatureController::class, 'storeGallery'])->name('gallery.store');
        Route::delete('/gallery/{photo}', [\App\Http\Controllers\CardFeatureController::class, 'destroyGallery'])->name('gallery.destroy');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
