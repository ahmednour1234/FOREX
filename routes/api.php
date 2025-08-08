<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// routes/api.php
use App\Http\Controllers\API\LeadFormController;

Route::match(['get', 'post'], '/lead-form', [LeadFormController::class, 'handle']);
