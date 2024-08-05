<?php

use App\Http\Controllers\HospitalController;
use App\Http\Controllers\ItemController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/', [SuggestionController::class, 'index'])->name('suggestions.index');
    Route::get('/tai-khoan', [UserController::class, 'index'])->name('account.index');
    Route::get('/them-tai-khoan', [UserController::class, 'create'])->name('account.create');
    Route::post('/them-tai-khoan', [UserController::class, 'store'])->name('account.store');

    Route::get('/de-nghi/tao-moi', [SuggestionController::class, 'create'])->name('suggestion.create');
    Route::post('/de-nghi/tao-moi', [SuggestionController::class, 'store'])->name('suggestion.store');
    Route::get('/de-nghi/{id}', [SuggestionController::class, 'detail'])->name('suggestion.detail');
    Route::put('/de-nghi/{id}', [SuggestionController::class, 'update'])->name('suggestion.update');
    Route::delete('/de-nghi/{id}', [SuggestionController::class, 'destroy'])->name('suggestion.destroy');

    Route::get('/doi-mat-khau', [UserController::class, 'changePassword'])->name('account.changePassword');
    Route::put('/doi-mat-khau', [UserController::class, 'updatePassword'])->name('account.updatePassword');
    Route::put('/khoa-tai-khoan/{id}', [UserController::class, 'banAccount'])->name('account.ban');

    Route::get('/vat-chat', [ItemController::class, 'index'])->name('items.index');
    Route::get('/vat-chat/tao-moi', [ItemController::class, 'create'])->name('item.create');
    Route::post('/vat-chat/tao-moi', [ItemController::class, 'store'])->name('item.store');
    Route::get('/vat-chat/{id}', [ItemController::class, 'edit'])->name('item.edit');
    Route::put('/vat-chat/{id}', [ItemController::class, 'update'])->name('item.update');
    Route::delete('/vat-chat/{id}', [ItemController::class, 'destroy'])->name('item.destroy');
    Route::get('/vat-chat/{id}', [ItemController::class, 'detail'])->name('item.detail');

    Route::get('/benh-vien', [HospitalController::class, 'index'])->name('hospitals.index');
});