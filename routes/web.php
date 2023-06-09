<?php

use App\Http\Controllers\GooglesheetController;
use App\Http\Controllers\SheetdbController;
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

Route::get('/googlesheet', [GooglesheetController::class, 'get'])->name('googlesheet.get');
Route::get('/sheetdb', [SheetdbController::class, 'get'])->name('sheetdb.get');
