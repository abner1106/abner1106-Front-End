<?php

use App\Http\Controllers\EquipoController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\MantenimientoController;

Route::resource('equipos', EquipoController::class);
Route::resource('ubicaciones', UbicacionController::class);
Route::resource('mantenimientos', MantenimientoController::class);