<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

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
Route::get('/admin/add', [ProductController::class, 'showAddForm'])->name('admin.add')->middleware('auth');
Route::get('/admin/remove', [ProductController::class, 'showRemoveForm'])->name('admin.remove')->middleware('auth');
Route::get('/admin/report', [ProductController::class, 'showReport'])->name('admin.report')->middleware('auth');




