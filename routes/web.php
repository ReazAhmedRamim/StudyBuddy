<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\UserController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\TutorController;
use App\Http\Controllers\backend\StudentController;
use App\Http\Controllers\backend\CourseController;
use App\Http\Controllers\backend\CourseSectionController;
use App\Http\Controllers\backend\AdminProfileController;
use App\Http\Controllers\backend\AdminSettingController;
use App\Http\Controllers\backend\TutorProfileController;
use App\Http\Controllers\backend\StudentProfileController;

use App\Http\Controllers\CKEditorController;

// Example route
Route::get('/tutor/course-section/{id}', [CourseSectionController::class, 'show'])
    ->name('tutor.course-section.show');
Route::delete('/tutor/courses/{course}', [CourseController::class, 'destroy'])->name('tutor.courses.destroy');


Route::delete('/tutor/course/{id}', [CourseController::class, 'destroy'])->name('tutor.course.delete');


Route::post('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');
Route::middleware(['auth'])->prefix('tutor')->name('tutor.')->group(function () {
    Route::resource('course', \App\Http\Controllers\Tutor\CourseController::class);
});


// -------------------- Authentication Routes --------------------
Route::get('/', [AuthManager::class, 'login'])->name('login');
Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'authenticate'])->name('login.post');
Route::get('/registration', [AuthManager::class, 'registration'])->name('reg');
Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('reg.post');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');
Route::get('/studentProfile', [AuthManager::class, 'student'])->name('student.profile');

// -------------------- Admin Routes --------------------
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('users');

    Route::patch('/users/{user}/approve', [AdminController::class, 'approveUser'])->name('users.approve');
    Route::patch('/users/{user}/ban', [AdminController::class, 'banUser'])->name('users.ban');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');

    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/setting', [AdminSettingController::class, 'setting'])->name('profile.setting');
    Route::post('/profile/setting', [AdminSettingController::class, 'updateSetting'])->name('profile.setting.update');
    Route::post('/logout', [AdminController::class, 'destroy'])->name('logout');
});

// -------------------- Backend Resource Controllers --------------------
Route::prefix('backend')->middleware(['auth'])->group(function () {
    Route::resource('courses', CourseController::class);
    Route::resource('sections', CourseSectionController::class);
    Route::resource('students', StudentController::class);
    Route::resource('tutors', TutorController::class);
});

// -------------------- Tutor Routes --------------------
Route::prefix('tutor')->name('tutor.')->middleware(['auth'])->group(function () {
    Route::get('dashboard', [TutorController::class, 'dashboard'])->name('dashboard');
    Route::post('logout', [TutorController::class, 'destroy'])->name('logout');

    Route::get('profile', [TutorProfileController::class, 'index'])->name('profile');
    Route::put('profile/update', [TutorProfileController::class, 'update'])->name('profile.update');
    Route::post('password/update', [TutorProfileController::class, 'updatePassword'])->name('password.update');
    Route::get('profile/setting', [TutorProfileController::class, 'setting'])->name('profile.setting');

    Route::controller(UserController::class)->group(function () {
        Route::get('chatbox', 'chatbox')->name('chatbox');
        Route::get('chat/{id}', 'userChat')->name('chat');
    });

    Route::resource('course', CourseController::class);
});

// -------------------- Student Routes --------------------
Route::prefix('student')->name('student.')->middleware(['auth'])->group(function () {
    Route::get('dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::post('logout', [StudentController::class, 'destroy'])->name('logout');

    Route::get('profile', [StudentProfileController::class, 'index'])->name('profile');
    Route::put('profile/update', [StudentProfileController::class, 'update'])->name('profile.update');
    Route::post('password/update', [StudentProfileController::class, 'updatePassword'])->name('password.update');
    Route::get('profile/setting', [StudentProfileController::class, 'setting'])->name('profile.setting');

    Route::controller(UserController::class)->group(function () {
        Route::get('chatbox', 'chatbox_student')->name('chatbox');
        Route::get('chat/{id}', 'userChat')->name('chat');
    });
});
