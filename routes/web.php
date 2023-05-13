<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::controller(ListingController::class)->group(function()
{
    // listing index
    Route::get('/', 'index');
    // show form to create a list
    Route::get('/listings/create', 'create')->middleware('auth');
    // store a list
    Route::post('/listings', 'store')->middleware('auth');

    Route::get('/listings/manage', 'manage')->middleware('auth');
    // show a single list
    Route::get('/listings/{listing}', 'show');
    // show edit form
    Route::get('/listings/{listing}/edit', 'edit')->middleware('auth');
    // update the list
    Route::put('/listings/{listing}', 'update')->middleware('auth');
    // destroy the list
    Route::delete('/listings/{listing}', 'destroy')->middleware('auth');
});

Route::controller(UserController::class)->group(function()
{
    // show register form
    Route::get('/register', 'create')->middleware('guest');
    // show login form
    Route::get('/login', 'login')->name('login')->middleware('guest');
    // create/store a new user
    Route::post('/users', 'store')->middleware('guest');

    Route::post('/logout', 'logout')->middleware('auth');

    Route::post('/users/authenticate', 'authenticate')->middleware('guest');
});
