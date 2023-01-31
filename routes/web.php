<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OffersController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource("/users", UsersController::class);
});



Route::resource("/", OffersController::class);
Route::get("/search", [OffersController::class, 'search']);
Route::get("/searchMultiple", [OffersController::class, 'searchMultiple']);

Route::resource("/offers", OffersController::class);
Route::post("offers/{id}/makeOrder", [OffersController::class, 'makeOrder']);

# laravel/ui bootstrap auth
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

