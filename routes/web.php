<?php

use App\Http\Controllers\HomeController;
use App\Http\Middleware\CheckStorages;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])
->middleware(CheckStorages::class);