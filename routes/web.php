<?php

use App\Http\Controllers\BerandaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//TAMPILKAN JAM
// Route::get('/home', function () {
//     return view('home');
// });

Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');