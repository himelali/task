<?php

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

Route::get('/', [\App\Http\Controllers\ShortenerController::class, 'index']);

Route::post('/', [\App\Http\Controllers\ShortenerController::class, 'create']);

Route::get('/{hash}', [\App\Http\Controllers\ShortenerController::class, 'view'])
    ->whereAlphaNumeric('hash')->name('short_url');
