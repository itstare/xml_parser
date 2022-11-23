<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParserController;

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
    return view('home');
});

Route::post('/insert', [ParserController::class, 'insert'])->name('insert');
Route::get('/view/{id}', [ParserController::class, 'interface'])->name('interface');
Route::post('/update/{id}', [ParserController::class, 'update'])->name('update');
Route::get('/xml-code/{id}', [ParserController::class, 'generateCode'])->name('generateCode');

