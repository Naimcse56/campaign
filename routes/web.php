<?php

use App\Http\Controllers\CampaignController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'welcome')->name('welcome');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
    });
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile-settings', 'profile_setup')->name('profile-settings');
        Route::post('/profile-update', 'profile_update')->name('profile_update');
        Route::post('/password-update', 'password_update')->name('password_update');
    });
    Route::controller(ShopController::class)->prefix('shop/')->group(function () {
        Route::get('list', 'index')->name('shop.index');
        Route::post('store', 'store')->name('shop.store');
        Route::get('edit/{id}', 'edit')->name('shop.edit');
        Route::post('update/{id}', 'update')->name('shop.update');
        Route::post('delete', 'destroy')->name('shop.delete');
    });
    Route::controller(CampaignController::class)->prefix('campaign/')->group(function () {
        Route::get('list', 'index')->name('campaign.index');
        Route::post('store', 'store')->name('campaign.store');
        Route::get('edit/{id}', 'edit')->name('campaign.edit');
        Route::get('show/{id}', 'show')->name('campaign.show');
        Route::post('update/{id}', 'update')->name('campaign.update');
        Route::post('delete', 'destroy')->name('campaign.delete');

        Route::get('create-form/{campaign}', 'createForm')->name('form.create');
        Route::get('/form/{campaign}', 'showForm')->name('form.show');
        Route::post('/form-fields/{campaign}', 'saveFormFields')->name('form_fields.save');
    });
});
