<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TutorProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\TutorController;
use App\Http\Controllers\Tutor\ProfileController;
use App\Http\Controllers\Tutor\SettingController;

Route::get('/',[AuthManager::class,'login'])->name('login') ;

Route::get('/login',[AuthManager::class,'login'])->name('login') ;


Route::post('/login',[AuthManager::class,'loginPost'])->name('login.post') ;

Route::get('/registration',[AuthManager::class,'registration'])->name('reg');

Route::post('/registration',[AuthManager::class,'registrationPost'])->name('reg.post');

Route::get('/logout',[AuthManager::class,'logout'])->name('logout') ;

Route::get('/studentProfile',[AuthManager::class,'student'])->name('student') ;

Route::get('/adminProfile',[AuthManager::class,'admin'])->name('admin') ;

Route::get('/tutorProfile',[AuthManager::class,'tutor'])->name('tutor') ;


Route::prefix('tutor')
    ->name('tutor.')
    ->group(function () {
        Route::get('/dashboard', [tutorController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [tutorController::class, 'destroy'])->name('logout');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::get('/setting', [SettingController::class, 'index'])->name('setting'); //apadoto kaaj dekhtesi nah?
    });

Route::put('/tutor/profile/update', [TutorProfileController::class, 'update'])->name('tutor.profile.update');
Route::post('/tutor/password/update', [TutorProfileController::class, 'updatePassword'])->name('tutor.passwordSetting');
Route::get('/tutor/settings', [TutorProfileController::class, 'settings'])->name('tutor.profile.setting');

Route::controller(UserController::class)->group(function(){
    Route::get('/tutor/chatbox','chatbox')->name('tutor.chatbox');
    Route::get('chat/{id}','userChat')->name('chat');
});

