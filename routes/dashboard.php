<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;

Route::group([
    "middleware"=> ["auth" , "verified"],
    "as"=> "dashboard.",
    "prefix" => "dashboard",
],
 function () {
     
     Route::get('/', [DashboardController::class , 'index'])
     ->middleware(['auth', 'verified'])
     ->name('dashboard');
     Route::resource("/categories",CategoriesController::class)->middleware(['auth', 'verified']); //->except('show');
});
