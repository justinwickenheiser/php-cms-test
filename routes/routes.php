<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['web'])->group(__DIR__.'/admin.php');

// Middleware(['web']) is necessary othewise the package doesn't pick up the primary Application Project DB connection.
Route::middleware(['web'])->group(__DIR__.'/web.php');