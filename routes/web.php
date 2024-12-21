<?php

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\RentalController;

Route::resource('equipments', EquipmentController::class);
Route::resource('rentals', RentalController::class);