<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChecksController;
use Illuminate\Support\Facades\Auth;

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
    return view('layouts/app');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// login with github
Route::get('/login/github', [LoginController::class, 'redirectToGithub'])->name('login.github');

Route::get('/login/github/callback', [LoginController::class, 'handlGithubCallback']);

// login with google
Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');

Route::get('/login/google/callback', [LoginController::class, 'handlGoogleCallback']);

//login with facebook
Route::get('/login/facebook', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');

Route::get('/login/facebook/callback', [LoginController::class, 'handlFacebookCallback']);

Route::get('{any}', function () {
    return view('home');
})->where('any', '.*');