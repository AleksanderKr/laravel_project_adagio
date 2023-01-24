<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OffersController;


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

Route::get('/database_test', function() {
    return view('database_test');
});

Route::get('/CRUD', function() {
    return view('CRUD');
});

Route::resource("/users", UsersController::class);

Route::resource("/", OffersController::class);
Route::get("/search", [OffersController::class, 'search']);
Route::get("/searchMultiple", [OffersController::class, 'searchMultiple']);

# bootstrap auth
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
