<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/thanks', [AuthController::class, 'thanks']);

Route::middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/', [ItemController::class, 'index']);
    }
);
