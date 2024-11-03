<?php

use App\Http\Controllers\Dashbaord\DashboardController;
use App\Http\Controllers\Dashbaord\GameController;
use App\Http\Controllers\Dashbaord\MultiGameController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class, 'index']);

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/games', [GameController::class, 'games'])->name('games');
    Route::get('/game/create', [GameController::class, 'create'])->name('games.create');
    Route::post('/game/store', [GameController::class, 'store'])->name('game.store');

    //---multi games ---
    Route::get('/multigame/create', [MultiGameController::class, 'create'])->name('multigames.create');
    Route::post('/multigame/store', [MultiGameController::class, 'store'])->name('multigame.store');

});
