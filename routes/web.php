<?php

use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\UserController;
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

Route::get('/dang-nhap', [UserController::class, 'login'])->name('login');
Route::post('/dang-nhap', [UserController::class, 'postLogin'])->name('postLogin');
Route::get('/dang-xuat', [UserController::class, 'logout'])->name('logout');

Route::get('/', [SuggestionController::class, 'index'])->name('suggestion.index');
Route::get('/tai-khoan', [UserController::class, 'index'])->name('account.index');
Route::get('/them-tai-khoan', [UserController::class, 'create'])->name('account.create');
Route::post('/them-tai-khoan', [UserController::class, 'store'])->name('account.store');