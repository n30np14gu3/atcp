<?php

use App\Http\Controllers\TopInfoController;
use App\Modules\Api\EndpointInfoGetter;
use Illuminate\Support\Facades\Route;

Route::get('appTopCategory', [TopInfoController::class, 'appTopCategory']);
