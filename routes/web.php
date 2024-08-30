<?php

use App\Http\Controllers\Inside\AuthController;
use App\Http\Controllers\Inside\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/custom-page', \App\Filament\Pages\CustomPage::class)
    ->name('custom.page')
    ->middleware(['auth']);

//Route group admin
Route::group(['prefix' => 'inside'], function () {
    Route::any('/login', [AuthController::class, 'login'])->name('inside.login');
    Route::group(['middleware' => ['auth']], function () {
        Route::any('/settings', [SettingController::class, 'index'])->name('setting.index');
    });
});

