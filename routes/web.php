<?php

use App\Livewire\Game;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

Route::get('/', Game::class)->name('home');
Livewire::setScriptRoute(function ($handle) { return Route::get('/livewire/livewirejs', $handle); });
