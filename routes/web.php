<?php

use App\Http\Controllers\SwitchCurrentTeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::put('/switch-team', SwitchCurrentTeamController::class)->name('switch-team');
