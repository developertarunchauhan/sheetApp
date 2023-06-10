<?php

use App\Http\Controllers\GooglesheetController;
use App\Http\Controllers\SheetController;
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

Route::resource('sheet', SheetController::class)->middleware('auth');

Route::group(['prefix' => 'sheet'], function () {
    Route::get('/sync/{sync}', [SheetController::class, 'sync'])->name('sheet.sync');
    Route::get('/insert/{insert}', [SheetController::class, 'insert'])->name('sheet.insert');
    Route::get('/delete_from_sheet/{delete}', [SheetController::class, 'delete_from_sheet'])->name('sheet.delete_from_sheet');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
