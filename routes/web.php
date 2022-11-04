<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Language;
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
Route::group(['middleware'=>'language'],function () {
    Route::get('/', function () {
        return view('index');
    })->name('main');

    Route::get('/language/{locale}', [Language::class, 'switchLocale'])->name('language.change');
    Route::post('/calculate', [Controller::class, 'calculate']);

});
