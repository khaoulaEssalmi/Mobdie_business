<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Auth\RedirectAuthenticatedUsersController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Route::get('/manager',[App\Http\Controllers\Auth\CustomAuthController::class,'manager'])->middleware('checkRole')->name('Manager');
//Route::get('/analyst',[App\Http\Controllers\Auth\CustomAuthController::class,'analyst'])->middleware('checkRole')->name('Analyst');

Route::middleware(['auth:manager'])->group(function () {
    Route::get('/manager/dashboard', function () {
        return view('managerHome');
    });
});

Route::middleware(['auth:analyst'])->group(function () {
    Route::get('/analyst/dashboard', function () {
        return view('analystHome');
    });
});

Route::middleware(['auth:formateur'])->group(function () {
    Route::get('/formateur/dashboard', function () {
        return view('formateurHome');
    });
});

require __DIR__.'/auth.php';
