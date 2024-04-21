<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;


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
    return view('auth.login');
});


Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [BookController::class, 'index']);
    Route::get('/book', [BookController::class, 'index']);
    Route::get('/book/create', [BookController::class, 'create']);
    Route::post('/book/store', [BookController::class, 'store']);
    Route::get('/book/{id}/edit', [BookController::class, 'edit']);
    Route::post('/book/update/{id}', [BookController::class, 'update']);
    Route::delete('/book/delete/{id}', [BookController::class, 'destroy']);

    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/create', [UserController::class, 'create']);
    Route::post('/user/store', [UserController::class, 'store']);
    Route::get('/user/{id}/edit', [UserController::class, 'edit']);
    Route::post('/user/update/{id}', [UserController::class, 'update']);
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy']);

    Route::get('/issue-book', [BookController::class, 'issueBook']);
    Route::post('/book-issue/store', [BookController::class, 'storeIssuedDetails']);
    Route::get('/issued-book-list', [BookController::class, 'issuedBookList']);
    Route::get('/borrowal-book/edit/{id}', [BookController::class, 'borrowalDetailsEdit']);
    Route::post('/borrowal-book/{id}/update', [BookController::class, 'borrowalDetailsUpdate']);
    Route::post('/borrowal-book/return/{id}', [BookController::class, 'borrowalBookReturn']);

    Route::get('/logout', [LoginController::class, 'logout']);
});

