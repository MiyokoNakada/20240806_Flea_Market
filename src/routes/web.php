<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SellController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/thanks', [AuthController::class, 'thanks']);

Route::get('/', [ItemController::class, 'index']);
Route::post('/item/search', [ItemController::class, 'search']);
Route::get('/item/{item_id}', [ItemController::class, 'detail']);


Route::middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/mypage', [MypageController::class, 'mypage']);
        Route::get('/mypage/profile', [MypageController::class, 'profile']);

        
        Route::get('/purchase/payment_method', [PurchaseController::class, 'paymentMethod']);
        Route::get('/purchase/address', [PurchaseController::class, 'addressChange']);
        Route::get('/purchase/{item_id}', [PurchaseController::class, 'purchase']);
        
        Route::get('/sell', [SellController::class, 'sellerPage']);
        Route::post('/sell', [SellController::class, 'sell']);
        
    }
);
