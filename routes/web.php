<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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
    return view('welcome');
});
Route::get('/contacts', [ContactController::class, 'index'])->name('welcome');
Route::get('/create', [ContactController::class, 'create'])->name('create');
Route::post('/contacts', [ContactController::class, 'store'])->name('store');
Route::get('/generate', [ContactController::class, 'generateRandomContacts'])->name('generate');
Route::resource('contacts', ContactController::class)->except(['create', 'edit']);
