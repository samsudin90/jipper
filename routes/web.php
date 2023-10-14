<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DesignController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);

    Route::get('/admin/category', [AdminController::class, 'indexCategory']);
    Route::post('/admin/category', [AdminController::class, 'storeCategory']);
    Route::delete('/admin/category/{id}', [AdminController::class, 'destroyCategory']);
    Route::get('/admin/category/{id}', [AdminController::class, 'editCategory']);
    Route::put('/admin/category/{id}', [AdminController::class, 'updateCategory']);

    Route::get('/admin/material', [AdminController::class, 'indexMaterial']);
    Route::post('/admin/material', [AdminController::class, 'storeMaterial']);
    Route::delete('/admin/material/{id}', [AdminController::class, 'destroyMaterial']);
    Route::get('/admin/material/{id}', [AdminController::class, 'editMaterial']);
    Route::put('/admin/material/{id}', [AdminController::class, 'updateMaterial']);
    
    Route::get('/admin/product', [AdminController::class, 'indexProduct']);
    Route::post('/admin/product', [AdminController::class, 'storeProduct']);
    Route::delete('/admin/product/{id}', [AdminController::class, 'destroyProduct']);
    Route::get('/admin/product/{id}', [AdminController::class, 'editProduct']);
    Route::put('/admin/product/{id}', [AdminController::class, 'updateProduct']);
    Route::get('/admin/product/image/{id}', [AdminController::class, 'addImage']);
    Route::delete('/admin/product/image/{id}', [AdminController::class, 'destroyImage']);
    Route::post('/admin/product/image', [AdminController::class, 'storeImage']);
    Route::get('/admin/product/material/{id}', [AdminController::class, 'addMaterial']);
    Route::post('/admin/product/material', [AdminController::class, 'storeProductMaterial']);

    Route::get('/admin/design', [DesignController::class, 'indexAdmin']);
    Route::post('/admin/design', [DesignController::class, 'store']);
    Route::get('/admin/design/image/{id}', [DesignController::class, 'addImage']);
    Route::delete('/admin/design/image/{id}', [DesignController::class, 'destroyImage']);
    Route::delete('/admin/design/{id}', [DesignController::class, 'destroy']);
    Route::get('/admin/design/{id}', [DesignController::class, 'edit']);
    Route::put('/admin/design/{id}', [DesignController::class, 'update']);
    Route::post('/admin/design/image', [DesignController::class, 'storeImage']);
});

// product
Route::get('/', [ProductController::class, 'index']);
Route::get('/shop/{id}', [ProductController::class, 'detail']);
Route::get('/product/{name}', [ProductController::class, 'product']);
// design
Route::get('/design/{name}', [ProductController::class, 'design']);
// cart
Route::post('/cart', [CartController::class, 'store']);
Route::get('/cart', [CartController::class, 'index']);
Route::delete('/cart/{id}', [CartController::class, 'destroy']);
Route::get('/cart/increment/{id}', [CartController::class, 'increment']);
Route::get('/cart/decrement/{id}', [CartController::class, 'decrement']);
Route::get('/invoice/{id}', [CartController::class, 'invoice']);
Route::post('/checkout', [CartController::class, 'checkout']);
Route::get('/checkout/{id}', [CartController::class, 'checkoutDetail']);


Route::get('/contact', function () {
    $title = "Contact";
    $user = Auth::user();
    return view('contact', compact('title', 'user'));
});
Route::get('/size', function () {
    $title = "Size";
    $user = Auth::user();
    return view('size', compact('title', 'user'));
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/signup', [AuthController::class, 'signup']);
Route::post('/signup', [AuthController::class, 'store']);