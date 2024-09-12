<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Support\Facades\Route;

//home routes
Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/search', [HomeController::class, 'search'])->name('homepage.search');

//account routes
Route::get('/login', [HomeController::class, 'login'])->name('homepage.login');
Route::post('/login', [HomeController::class, 'check_login']);
Route::get('/register', [HomeController::class, 'register'])->name('homepage.register');
Route::post('/register', [HomeController::class, 'check_register']);
Route::get('/verify-account/{email}', [HomeController::class, 'verify'])->name('homepage.verify');
Route::get('/forgot-password', [HomeController::class, 'forgot_password'])->name('homepage.forgot_password');
Route::post('/forgot-password', [HomeController::class, 'check_forgot_password']);
Route::get('/reset-password', [HomeController::class, 'reset_password'])->name('homepage.reset_password');
Route::post('/reset-password', [HomeController::class, 'check_reset_password']);
Route::get('/logout', [HomeController::class, 'logout'])->name('homepage.logout');

//courses routes
Route::get('/course/{course}/detail', [CourseController::class, 'coourse_detail'])->name('courses.detail');

//categories routes
Route::get('/category/{category}/filter', [CategoryController::class, 'filter'])->name('category.filter');


//admin routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    //accounts
    Route::get('/', [AdminController::class, 'account'])->name('admin');
    Route::get('/accounts', [AdminController::class, 'account'])->name('admin.accounts.index');
    Route::get('/accounts/create', [AdminController::class, 'create_account'])->name('admin.accounts.create');
    Route::post('/accounts', [AdminController::class, 'store_account'])->name('admin.accounts.store');
    Route::get('/accounts/{user}/edit', [AdminController::class, 'edit_account'])->name('admin.accounts.edit');
    Route::put('/accounts/{user}', [AdminController::class, 'update_account'])->name('admin.accounts.update');
    Route::delete('/accounts/{user}', [AdminController::class, 'destroy_account'])->name('admin.accounts.destroy');
    //categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    //courses
    Route::get('/courses', [CourseController::class, 'index'])->name('admin.courses.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('admin.courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('admin.courses.store');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('admin.courses.edit');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('admin.courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('admin.courses.destroy');
});

//teacher routes
Route::group(['prefix' => 'teacher', 'middleware' => ['auth', 'teacher']], function () {
    //courses
    Route::get('/', [TeacherController::class, 'courses'])->name('teacher');
    Route::get('/courses', [TeacherController::class, 'courses'])->name('teacher.courses.index');
    Route::get('/courses/create', [TeacherController::class, 'create_course'])->name('teacher.courses.create');
    Route::post('/courses', [TeacherController::class, 'store_course'])->name('teacher.courses.store');
    Route::get('/courses/{course}/edit', [TeacherController::class, 'edit_course'])->name('teacher.courses.edit');
    Route::put('/courses/{course}', [TeacherController::class, 'update_course'])->name('teacher.courses.update');
    Route::delete('/courses/{course}', [TeacherController::class, 'destroy_course'])->name('teacher.courses.destroy');
    //tests
    Route::get('/tests', [TeacherController::class, 'tests'])->name('teacher.tests.index');
    Route::get('/tests/create', [TeacherController::class, 'create_test'])->name('teacher.tests.create');
    Route::post('/tests', [TeacherController::class, 'store_test'])->name('teacher.tests.store');
    Route::get('/tests/{test}/edit', [TeacherController::class, 'edit_test'])->name('teacher.tests.edit');
    Route::put('/tests/{test}', [TeacherController::class, 'update_test'])->name('teacher.tests.update');
    Route::delete('/tests/{test}', [TeacherController::class, 'destroy_test'])->name('teacher.tests.destroy');
    Route::get('/tests/{test}/question', [TeacherController::class, 'test_detail'])->name('teacher.tests.detail');
    //questions
    Route::get('/questions/create/{test}', [TeacherController::class, 'create_question'])->name('teacher.questions.create');
    Route::post('/questions', [TeacherController::class, 'store_question'])->name('teacher.questions.store');
    Route::get('/questions/{question}/edit', [TeacherController::class, 'edit_question'])->name('teacher.questions.edit');
    Route::put('/questions/{question}', [TeacherController::class, 'update_question'])->name('teacher.questions.update');
    Route::delete('/questions/{question}', [TeacherController::class, 'destroy_question'])->name('teacher.questions.destroy');
});

//user routes
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::put('/profile', [UserController::class, 'check_profile'])->name('check_change_profile');
Route::post('/profile', [UserController::class, 'change_avatar'])->name('change_avatar');
Route::get('/profile/password', [UserController::class, 'password'])->name('password');
Route::post('/profile/password', [UserController::class, 'check_password'])->name('check_change_password');
Route::get('/forgot-password', [UserController::class, 'forgot_password'])->name('forgot_password');
Route::post('/forgot-password', [UserController::class, 'check_forgot_password'])->name('check_forgot_password');
Route::get('/reset-password/{token}', [UserController::class, 'reset_password'])->name('reset_password');
Route::post('/reset-password/{token}', [UserController::class, 'check_reset_password'])->name('check_reset_password');

