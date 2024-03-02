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
     Route::get('categories/trash', [CategoriesController::class ,'trash'])->name('categories.trash');
     Route::put('categories/{category}/restore', [CategoriesController::class ,'restore'])->name('categories.restore');
     Route::delete('categories/{category}/force-delete', [CategoriesController::class ,'forceDelete'])->name('categories.force-delete');
     Route::resource("/categories",CategoriesController::class)->middleware(['auth', 'verified'])->except('show');
});
