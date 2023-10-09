<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionHeaderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login.page');
});

Route::get('/login', [LoginController::class, 'loginPage'])->name('login.page');
Route::post('/login', [LoginController::class, 'login'])->name('login.user');
Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');

/* ADMIN */
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('/products', [ProductController::class, 'index'])->name('admin.product');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.product.store');
    Route::patch('/products/{productCode}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::get('/reports', [TransactionHeaderController::class, 'getReports'])->name('admin.reports');

    Route::get('/printReport', [TransactionHeaderController::class, 'print'])->name('admin.reports.print');
});

/* CLIENT */
Route::get('/products', [ProductController::class, 'client'])->name('client.products');
Route::get('/product/{productCode}', [ProductController::class, 'clientShow'])->name('client.product.single');
Route::get('/countcart', [CartController::class, 'itemCount'])->name('count.cart');
Route::get('/checkout', [CartController::class, 'checkoutPage'])->name('checkout.page');
Route::post('/addtocart', [CartController::class, 'addToCart'])->name('user.addtocart');
Route::post('/changeqty', [CartController::class, 'changeQty'])->name('user.chgqty');
Route::get('/checkoutitem', [CartController::class, 'checkoutItem'])->name('user.checkout');
