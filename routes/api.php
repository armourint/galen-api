<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalenController;

Route::post('galen/login', [GalenController::class, 'login']);

Route::get('galen/helloworld', [GalenController::class, 'helloworld']);