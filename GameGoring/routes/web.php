<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ScrapeController;
use Illuminate\Support\Facades\Route;

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
// Route::get('/scrap', function () {
//     return view('scrap');
// })->name("scrap");

Route::get('/', function () {
    return view('home');
})->name("home");

Route::get('/homepage', function () {
    return view('homepage');
})->name("homepage");

Route::post('/homepage/results', [ScrapeController::class,'submit'])->name("search-form");
