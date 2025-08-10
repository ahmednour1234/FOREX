<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// routes/api.php
use App\Http\Controllers\API\LeadFormController;
use App\Http\Controllers\API\ClientApiController;

Route::post('/clients/register', [ClientApiController::class, 'store']);

<<<<<<< HEAD
Route::post('/lead-form', [LeadFormController::class, 'store']);
Route::post('/dashboard/clients/{id}/send-code', [ClientApiController::class, 'resendQrCode'])->name('dashboard.clients.sendCode');
=======
Route::match(['get', 'post'], '/lead-form', [LeadFormController::class, 'handle']);
>>>>>>> origin/affaliate
