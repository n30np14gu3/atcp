<?php

use App\Http\Controllers\TopInfoController;
use Illuminate\Support\Facades\Route;

Route::get('appTopCategory', [TopInfoController::class, 'appTopCategory']);
