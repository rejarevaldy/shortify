<?php

use App\Models\Link;
use App\Models\Audit;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'index'])
        ->name('login');
    Route::post('login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('logout', LogoutController::class)->name('logout');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/{link}', function (string $link) {
        $link = Link::where('shorted_link', $link)->with(['link_audit'])->get()->first();
        if ($link->link_audit->status == 'active') {
            $link_audit = Audit::where('id', $link->link_audit_id)->get()->first();
            $link_audit->hit_count += 1;
            $link_audit->update();
            return redirect()->away($link->link);
        } else {
            return redirect()->back();
        }
    });
});
