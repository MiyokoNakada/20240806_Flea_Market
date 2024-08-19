<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\AdminController;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/thanks', [AuthController::class, 'thanks']);

Route::get('/', [ItemController::class, 'index'])->name('index');
Route::post('/item/search', [ItemController::class, 'search']);
Route::get('/item/{item_id}', [ItemController::class, 'detail'])->name('detail');


Route::middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/myfavourite', [ItemController::class, 'myFavourite']);
        Route::post('/item/{item_id}/comment', [ItemController::class, 'comment']);
        Route::delete('/item/{item_id}/comment/{comment_id}', [ItemController::class, 'deleteComment']);

        Route::post('/favourite/{item_id}', [FavouriteController::class, 'favourite']);
        Route::delete('/unfavourite/{item_id}', [FavouriteController::class, 'unfavourite']);
        Route::get('/favourite_count/{item_id}', [FavouriteController::class, 'favouriteCount']);

        Route::get('/mypage', [MypageController::class, 'mypage']);
        Route::get('/mypage/bought_items', [MypageController::class, 'boughtItems']);
        Route::get('/mypage/profile', [MypageController::class, 'profile']);
        Route::post('/mypage/profile', [MypageController::class, 'updateProfile']);

        Route::get('/purchase/payment_method/{item_id}', [PurchaseController::class, 'paymentMethod']);
        Route::post('/purchase/payment_method', [PurchaseController::class, 'changePaymentMethod']);
        Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'addressChange']);
        Route::post('/purchase/address', [PurchaseController::class, 'updateAddress']);
        Route::get('/purchase/{item_id}', [PurchaseController::class, 'purchase'])->name('purchase');
        Route::post('/purchase/{item_id}', [PurchaseController::class, 'completeOrder']);
        Route::post('/purchase/{item_id}/payment', [PurchaseController::class, 'payment']);

        Route::get('/sell', [SellController::class, 'sellerPage']);
        Route::post('/sell', [SellController::class, 'sell']);

        Route::group(['middleware' => ['auth', 'can:admin']], function () {
            Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
            Route::delete('/admin/delete_user', [AdminController::class, 'deleteUser']);
            Route::delete('/admin/delete_comment', [AdminController::class, 'deleteComment']);
            Route::post('/admin/send_email', [AdminController::class, 'sendEmail']);
        });
    }
);
