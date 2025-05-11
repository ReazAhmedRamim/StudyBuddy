<?php

// use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Auth;

// use App\Http\Controllers\AuthManager;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\CKEditorController;

// use App\Http\Controllers\backend\TutorController;
// use App\Http\Controllers\backend\StudentController;
// use App\Http\Controllers\backend\CourseController;
// use App\Http\Controllers\backend\CourseSectionController;
// use App\Http\Controllers\backend\AdminController;

// use App\Http\Controllers\TutorProfileController;
// use App\Http\Controllers\StudentProfileController;

// use App\Http\Controllers\AdminProfileController;
// use App\Http\Controllers\Admin\AdminSettingController;

// use App\Http\Controllers\LoginController;

// Route::patch('/admin/users/{user}/approve', [AdminController::class, 'approveUser'])->name('admin.users.approve');
// Route::patch('/admin/users/{user}/ban', [AdminController::class, 'banUser'])->name('admin.users.ban');


// // -------------------- Authentication --------------------
// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login'])->name('login.post');
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// // -------------------- Home Redirect --------------------
// Route::get('/', function () {
//     if (!Auth::check()) {
//         return redirect()->route('login');
//     }

//     $user = Auth::user();

//     if ($user->hasAdminAccess()) {
//         return redirect()->route('admin.dashboard');
//     } elseif ($user->role === \App\Models\User::ROLE_TUTOR) {
//         return redirect()->route('tutor.dashboard');
//     } elseif ($user->role === \App\Models\User::ROLE_STUDENT) {
//         return redirect()->route('student.dashboard');
//     }

//     return abort(403);
// });

// Route::patch('/admin/users/{id}/approve', [AdminController::class, 'approveUser'])->name('admin.users.approve');
// Route::patch('/admin/users/{id}/ban', [AdminController::class, 'banUser'])->name('admin.users.ban');


// // -------------------- Registration --------------------
// Route::controller(AuthManager::class)->group(function () {
//     Route::get('/registration', 'registration')->name('reg');
//     Route::post('/registration', 'registrationPost')->name('reg.post');
//     Route::get('/logout', 'logout')->name('logout');
// });

// // -------------------- CKEditor Upload --------------------
// Route::post('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');

// // -------------------- Admin Routes --------------------
// Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
//     Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
//     Route::get('/users', [AdminController::class, 'manageUsers'])->name('users');

//     Route::patch('/users/{user}/approve', [AdminController::class, 'approveUser'])->name('users.approve');
//     Route::patch('/users/{user}/ban', [AdminController::class, 'banUser'])->name('users.ban');
//     Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');

//     Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
//     Route::put('/profile/update', [AdminProfileController::class, 'update'])->name('profile.update');
//     Route::get('/profile/setting', [AdminSettingController::class, 'setting'])->name('profile.setting');
//     Route::post('/profile/setting', [AdminSettingController::class, 'updateSetting'])->name('profile.setting.update');

//     Route::post('/logout', [AdminController::class, 'destroy'])->name('logout');
// });

// // -------------------- Backend Resource Controllers --------------------
// Route::prefix('backend')->middleware(['auth'])->group(function () {
//     Route::resource('courses', CourseController::class);
//     Route::resource('sections', CourseSectionController::class);
//     Route::resource('students', StudentController::class);
//     Route::resource('tutors', TutorController::class);
// });

// // -------------------- Tutor Routes --------------------
// Route::prefix('tutor')->name('tutor.')->middleware(['auth'])->group(function () {
//     Route::get('dashboard', [TutorController::class, 'dashboard'])->name('dashboard');
//     Route::post('logout', [TutorController::class, 'destroy'])->name('logout');

//     Route::get('profile', [TutorProfileController::class, 'index'])->name('profile');
//     Route::put('profile/update', [TutorProfileController::class, 'update'])->name('profile.update');
//     Route::post('password/update', [TutorProfileController::class, 'updatePassword'])->name('password.update');
//     Route::get('profile/setting', [TutorProfileController::class, 'setting'])->name('profile.setting');

//     Route::resource('course', CourseController::class);
//     Route::get('course-section/{course}', [CourseSectionController::class, 'show'])->name('course-section.show');

//     Route::controller(UserController::class)->group(function () {
//         Route::get('chatbox', 'chatbox')->name('chatbox');
//         Route::get('chat/{id}', 'userChat')->name('chat');
//     });
// });

// // -------------------- Student Routes --------------------
// Route::prefix('student')->name('student.')->middleware(['auth'])->group(function () {
//     Route::get('dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
//     Route::post('logout', [StudentController::class, 'destroy'])->name('logout');

//     Route::get('profile', [StudentProfileController::class, 'index'])->name('profile');
//     Route::put('profile/update', [StudentProfileController::class, 'update'])->name('profile.update');
//     Route::post('password/update', [StudentProfileController::class, 'updatePassword'])->name('password.update');
//     Route::get('profile/setting', [StudentProfileController::class, 'setting'])->name('profile.setting');

//     Route::controller(UserController::class)->group(function () {
//         Route::get('chatbox', 'chatbox_student')->name('chatbox');
//         Route::get('chat/{id}', 'userChat')->name('chat');
//     });
// }); 

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CKEditorController;

use App\Http\Controllers\backend\TutorController;
use App\Http\Controllers\backend\StudentController;
use App\Http\Controllers\backend\CourseController;
use App\Http\Controllers\backend\CourseSectionController;
use App\Http\Controllers\backend\AdminController;

use App\Http\Controllers\TutorProfileController;
use App\Http\Controllers\StudentProfileController;

use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\Admin\AdminSettingController;

use App\Http\Controllers\LoginController;

// -------------------- Authentication --------------------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// -------------------- Home Redirect --------------------
Route::get('/', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $user = Auth::user();

    if ($user->hasAdminAccess()) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === \App\Models\User::ROLE_TUTOR) {
        return redirect()->route('tutor.dashboard');
    } elseif ($user->role === \App\Models\User::ROLE_STUDENT) {
        return redirect()->route('student.dashboard');
    }

    return abort(403);
});

// -------------------- Registration --------------------
Route::controller(AuthManager::class)->group(function () {
    Route::get('/registration', 'registration')->name('reg');
    Route::post('/registration', 'registrationPost')->name('reg.post');
    Route::get('/logout', 'logout')->name('logout');
});

// -------------------- CKEditor Upload --------------------
Route::post('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');

// -------------------- Admin Routes --------------------
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('users');

    // ✅ Use these clean and correct routes
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
