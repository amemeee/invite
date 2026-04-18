<?php

use App\Http\Controllers\ProfileController;
use App\Models\Card;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/i/{token}', [\App\Http\Controllers\CardController::class, 'invite'])->name('cards.invite');

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

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
