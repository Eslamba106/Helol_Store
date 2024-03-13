<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Middleware\CheckUserType;

Route::group([
    "middleware"=> ["auth:admin"],
    // "middleware"=> ["auth" , 'auth.type:admin,suber_admin'],
    "as"=> "dashboard.",
    "prefix" => "admin/dashboard",
],
 function () {

    Route::get('profile' , [ProfileController::class , 'edit'])->name('profile.edit');
    Route::patch('profile' , [ProfileController::class , 'update'])->name('profile.update');
     
     Route::get('/', [DashboardController::class , 'index'])
     ->middleware(['auth', 'verified'])
     ->name('dashboard');
     Route::get('categories/trash', [CategoriesController::class ,'trash'])->name('categories.trash');
     Route::put('categories/{category}/restore', [CategoriesController::class ,'restore'])->name('categories.restore');
     Route::delete('categories/{category}/force-delete', [CategoriesController::class ,'forceDelete'])->name('categories.force-delete');
     // Route::resource("/categories",CategoriesController::class)->middleware(['auth', 'verified'])->except('show');
     Route::resource("/categories",CategoriesController::class)->middleware(['auth', 'verified']);
     Route::resource('/products' , ProductController::class); //->except('show');
});
// Route::post('paypal' , function (){
//     return "Welcome Eslam";
// })->name('paypal');
