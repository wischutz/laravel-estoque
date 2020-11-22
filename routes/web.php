<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\PurchaseOrderController;

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

Route::get('/', [AuthController::class, 'dashboard'])->middleware('auth');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('admin.authenticate');
Route::get('/logoff', [AuthController::class, 'deauthenticate'])->name('admin.deauthenticate')->middleware('auth');

Route::get('/admin', [AuthController::class, 'dashboard'])->name('admin')->middleware('auth');
Route::get('/admin/purchase', [PurchaseOrderController::class, 'create'])->name('admin.purchase')->middleware('auth');
Route::post('/admin/purchase', [PurchaseOrderController::class, 'store'])->name('admin.purchase.store')->middleware('auth');
Route::get('/admin/sale', [SalesOrderController::class, 'create'])->name('admin.sale')->middleware('auth');
Route::post('/admin/sale', [SalesOrderController::class, 'store'])->name('admin.sale.store')->middleware('auth');

Route::get('/admin/product', [ProductController::class, 'index'])->name('product.index')->middleware('auth');
Route::get('/admin/product/create', [ProductController::class, 'create'])->name('product.create')->middleware('auth');
Route::post('/admin/product', [ProductController::class, 'store'])->name('product.store')->middleware('auth');
Route::get('/admin/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit')->middleware('auth');
Route::post('/admin/product/{id}', [ProductController::class, 'update'])->name('product.update')->middleware('auth');
Route::get('/admin/product/{id}/delete', [ProductController::class, 'destroy'])->name('product.destroy')->middleware('auth');
Route::get('/admin/product/report', [ProductController::class, 'report'])->name('product.report')->middleware('auth');
