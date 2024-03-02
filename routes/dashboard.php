<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ProductController;

Route::group([
    "middleware"=> ["auth" , "verified"],
    "as"=> "dashboard.",
    "prefix" => "dashboard",
],
 function () {
     
     Route::get('/', [DashboardController::class , 'index'])
     ->middleware(['auth', 'verified'])
     ->name('dashboard');
     Route::resource("/categories",CategoriesController::class)->middleware(['auth', 'verified']);
     Route::resource('/products' , ProductController::class); //->except('show');
});
// Route::get('products' , function (){
//     return "Welcome Eslam";
// })->name('dashboard.products.index');
