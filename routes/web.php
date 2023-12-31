<?php

use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('signed')->controller(MediaController::class)->group(function () {
    Route::get('/medias/{media:code}/download', 'downloadForm')->name('medias.downloadForm');
    Route::get('/medias/download/{media}', 'download')->name('medias.download');
});

Route::get('/medias/{media:code}/preview/{filename}', [MediaController::class, 'showFile'])->name('medias.show-file');
Route::resource('/medias', MediaController::class)->middleware('auth');


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
