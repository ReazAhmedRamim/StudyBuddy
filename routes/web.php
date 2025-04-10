<?php

use App\Http\Controllers\AuthManager;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login',[AuthManager::class,'login'])->name('login') ;

Route::post('/login',[AuthManager::class,'loginPost'])->name('login.post') ;

Route::get('/registration',[AuthManager::class,'registration'])->name('reg');

Route::post('/registration',[AuthManager::class,'registrationPost'])->name('reg.post');

Route::get('/logout',[AuthManager::class,'logout'])->name('logout') ;

Route::get('/studentProfile',[AuthManager::class,'student'])->name('student') ;

Route::get('/tutorProfile',[AuthManager::class,'tutor'])->name('tutor') ;
