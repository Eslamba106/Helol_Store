<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserType;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;

Route::group([
    "middleware"=> ["auth:admin"],
    // "middleware"=> ["auth" , 'auth.admin:admin'],
    "as"=> "dashboard.",
    "prefix" => "admin/dashboard",
],
 function () {

    Route::get('profile' , [ProfileController::class , 'edit'])
    ->middleware('auth:admin')
    ->name('profile.edit');
    Route::patch('profile' , [ProfileController::class , 'update'])->name('profile.update');
     
     Route::get('/', [DashboardController::class , 'index'])
     ->middleware(['auth:admin'])
     ->name('dashboard');
     Route::get('categories/trash', [CategoriesController::class ,'trash'])->name('categories.trash');
     Route::put('categories/{category}/restore', [CategoriesController::class ,'restore'])->name('categories.restore');
     Route::delete('categories/{category}/force-delete', [CategoriesController::class ,'forceDelete'])->name('categories.force-delete');
     // Route::resource("/categories",CategoriesController::class)->middleware(['auth', 'verified'])->except('show');
     Route::resource("/categories",CategoriesController::class)->middleware(['auth', 'verified']);
     Route::resource('/products' , ProductController::class); //->except('show');

});
Route::get('/admin/login' , [LoginController::class , 'loginPage'])->middleware('guest:admin')->name('admin.login-page');
Route::post('/admin/login' , [LoginController::class , 'login'])->middleware('guest:admin')->name('admin.login');
Route::post('/admin/logout' , [LoginController::class , 'logout'])->middleware('auth:admin')->name('admin.logout');
// Route::post('paypal' , function (){
//     return "Welcome Eslam";
// })->name('paypal');
