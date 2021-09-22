<?php

use App\Http\Controllers\ProductController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

Route::post('/login', [UserController::class, 'login']);
Route::view('login', 'login');

Route::view('/register', 'register');
Route::post('/registernow', [UserController::class, 'userRegistration']);

Route::get('/logout', function(){
    Session::forget('user');
    return redirect('login');
});

Route::get('/', [ProductController::class, 'index']);
Route::get('/detail/{id}', [ProductController::class, 'detail']);

Route::post('/add-to-cart', [ProductController::class, 'addToCart']);

Route::get('/cartlist', [ProductController::class, 'cartList']);

Route::get('/removecart/{id}', [ProductController::class, 'removeCart']);

Route::get('ordernow', [ProductController::class, 'orderNow']);

Route::post('orderplace', [ProductController::class, 'orderPlace']);

Route::get('/myorders', [ProductController::class, 'myOrder']);

Route::post('/products/validate-amount', [ProductController::class, 'validate_product']);

