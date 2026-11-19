<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TravelRegistrationController;

Route::get('/', function () {
    return redirect()->route('registrations.create');
});

Route::resource('registrations', TravelRegistrationController::class)->only([
    'index', 'create', 'store', 'destroy'
]);

Route::patch('/registrations/{registration}/status', [TravelRegistrationController::class, 'updateStatus'])
    ->name('registrations.updateStatus');
