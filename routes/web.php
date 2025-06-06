<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TutorProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\TutorController;
use App\Http\Controllers\Tutor\ProfileController;
use App\Http\Controllers\Tutor\SettingController;
use App\Http\Controllers\backend\CourseController;

use App\Http\Controllers\CKEditorController;


Route::prefix('tutor')->name('tutor.')->group(function() {
    Route::resource('course', \App\Http\Controllers\backend\CourseController::class);
});

// Inside your tutor route group
Route::prefix('tutor')->group(function () {
    // ... other routes
    
    // Add this course section route
    Route::get('/course-section/{course}', [CourseSectionController::class, 'show'])
         ->name('tutor.course-section.show');
});

// For resource controller
Route::prefix('tutor')->name('tutor.')->group(function() {
    Route::resource('course', \App\Http\Controllers\backend\CourseController::class);
});

Route::post('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');



use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\backend\StudentController;
use App\Http\Controllers\Student\profile;
use App\Http\Controllers\Student\StudentSettingController;


use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\Admin\AdminProfile;
use App\Http\Controllers\Admin\AdminSettingController;

Route::get('/',[AuthManager::class,'login'])->name('login') ;

Route::get('/login',[AuthManager::class,'login'])->name('login') ;


Route::post('/login',[AuthManager::class,'loginPost'])->name('login.post') ;

Route::get('/registration',[AuthManager::class,'registration'])->name('reg');

Route::post('/registration',[AuthManager::class,'registrationPost'])->name('reg.post');

Route::get('/logout',[AuthManager::class,'logout'])->name('logout') ;

Route::get('/studentProfile',[AuthManager::class,'student'])->name('student') ;

Route::get('/adminProfile',[AuthManager::class,'admin'])->name('admin') ;

Route::get('/tutorProfile',[AuthManager::class,'tutor'])->name('tutor') ;


// for tutor 

Route::resource('/course', CourseController::class);



Route::prefix('tutor')
    ->name('tutor.')
    ->group(function () {
        Route::get('/dashboard', [TutorController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [TutorController::class, 'destroy'])->name('logout');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::get('/setting', [SettingController::class, 'index'])->name('setting'); //apadoto kaaj dekhtesi nah?
    });

// Route::prefix('tutor')->name('tutor.')->group(function() {
//     Route::resource('course', \App\Http\Controllers\backend\CourseController::class);
//     Route::get('/dashboard', [TutorController::class, 'dashboard'])->name('dashboard');
//     Route::post('/logout', [TutorController::class, 'destroy'])->name('logout');
//     Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
//     Route::get('/setting', [SettingController::class, 'index'])->name('setting');
// });

Route::put('/tutor/profile/update', [TutorProfileController::class, 'update'])->name('tutor.profile.update');
Route::post('/tutor/password/update', [TutorProfileController::class, 'updatePassword'])->name('tutor.passwordSetting');
Route::get('/tutor/settings', [TutorProfileController::class, 'settings'])->name('tutor.profile.setting');

// for student 

Route::prefix('student')
->name('student.')
->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [StudentController::class, 'destroy'])->name('logout');

    Route::get('/profile', [profile::class, 'index'])->name('profile');
    Route::get('/setting', [StudentSettingController::class, 'index'])->name('setting'); //apadoto kaaj dekhtesi nah?
});

Route::put('/student/profile/update', [StudentProfileController::class, 'update'])->name('student.profile.update');
Route::post('/student/password/update', [StudentProfileController::class, 'updatePassword'])->name('student.passwordSetting');
Route::get('/student/settings', [StudentProfileController::class, 'settings'])->name('student.profile.setting');



Route::controller(UserController::class)->group(function(){
    Route::get('/tutor/chatbox','chatbox')->name('tutor.chatbox');
    Route::get('chat/{id}','userChat')->name('chat');
});

Route::controller(UserController::class)->group(function(){
    Route::get('/student/chatbox','chatbox_student')->name('student.chatbox');
    Route::get('chat/{id}','userChat')->name('chat');
});


// for admin 

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [AdminController::class, 'destroy'])->name('logout');

        Route::get('/profile', [AdminProfile::class, 'index'])->name('profile');
        Route::get('/setting', [AdminSettingController::class, 'index'])->name('setting'); //apadoto kaaj dekhtesi nah?
    });

Route::put('/admin/profile/update', [AdminProfileController::class, 'update'])->name('admin.profile.update');
Route::post('/admin/password/update', [AdminProfileController::class, 'updatePassword'])->name('admin.passwordSetting');
Route::get('/admin/settings', [AdminProfileController::class, 'settings'])->name('admin.profile.setting');
