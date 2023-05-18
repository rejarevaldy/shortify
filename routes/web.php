<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\LinkController;
use App\Http\Controllers\Ajax\LinkAjaxController;
use App\Http\Controllers\HomeController;

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




Route::group(['prefix' => 'app', 'middleware' => 'auth', 'as' => 'app.'], function () {
    Route::resource('links', LinkController::class)->names('link');
});

// Ajax
Route::group(['prefix' => 'ajax', 'middleware' => 'auth', 'as' => 'ajax.'], function () {
    Route::get('links/', [LinkAjaxController::class, 'getAll'])->name('ajax.links');
});

require __DIR__ . '/auth.php';
