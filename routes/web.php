<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//home routes
Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/search', [HomeController::class, 'search'])->name('homepage.search');
Route::get('/forgot-password', [UserController::class, 'forgot_password'])->name('forgot_password');
Route::post('/forgot-password', [UserController::class, 'check_forgot_password'])->name('check_forgot_password');
Route::get('/reset-password/{token}', [UserController::class, 'reset_password'])->name('reset_password');
Route::post('/reset-password/{token}', [UserController::class, 'check_reset_password'])->name('check_reset_password');

//account routes
Route::get('/login', [HomeController::class, 'login'])->name('homepage.login');
Route::post('/login', [HomeController::class, 'check_login'])->name('homepage.check_login');
Route::get('/register', [HomeController::class, 'register'])->name('homepage.register');
Route::post('/register', [HomeController::class, 'check_register'])->name('homepage.check_register');
Route::get('/verify-account/{email}', [HomeController::class, 'verify'])->name('homepage.verify');

Route::get('/logout', [HomeController::class, 'logout'])->name('homepage.logout');

//courses routes
Route::get('/course/{course}/detail', [CourseController::class, 'course_detail'])->name('courses.detail');


Route::group(['middleware' => ['auth']], function () {
    Route::post('/courses/detail/comment', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/courses/{course}/favorite', [CourseController::class, 'favorite'])->name('courses.favorite');
    Route::delete('/courses/{course}/favorite', [CourseController::class, 'unfavorite'])->name('courses.unfavorite');
    Route::get('/my_favorite_list', [UserController::class, 'favorite_list'])->name('favorite_list');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserController::class, 'check_profile'])->name('check_change_profile');
    Route::post('/profile/avatar', [UserController::class, 'change_avatar'])->name('change_avatar');
    Route::post('/profile/password', [UserController::class, 'check_password'])->name('check_change_password');
    Route::post('/course/enroll/{course_id}', [CourseController::class, 'enroll'])->name('courses.enroll');
    Route::delete('/my_courses/{course}/unenroll', [CourseController::class, 'unenroll'])->name('courses.unenroll');   
    Route::get('/courses/view/{course_id}', [CourseController::class, 'view'])->name('courses.view');
    Route::get('/courses_enrolled', [HomeController::class, 'getEnrolledCourses'])->name('courses.enrolled');
    Route::get('/my_courses', [HomeController::class, 'my_courses'])->name('my_courses');
    Route::get('/tests/{test_id}', [TestController::class, 'index'])->name('test.view');
    Route::get('/tests/{test}/taking', [TestController::class, 'takingTest'])->name('taking_test');
    Route::post('/tests/{test}/submit', [TestController::class, 'submitTest'])->name('submit_test');
    Route::get('/tests/{test}/results', [TestController::class, 'showResults'])->name('test.results');
});

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
    Route::get('/tests/{test}/detail', [TeacherController::class, 'test_detail'])->name('teacher.tests.detail');
    //test results
    Route::get('/tests_results', [TeacherController::class, 'test_results'])->name('teacher.tests.results');
    Route::get('/tests_results/{test}/detail', [TeacherController::class, 'view_test_detail'])->name('teacher.tests.result_detail');
    Route::post('/feedbacks', [TeacherController::class, 'storeFeedback'])->name('feedbacks.store');
    Route::put('/feedbacks/{id}', [TeacherController::class, 'updateFeedback'])->name('feedbacks.update');
    Route::delete('/feedbacks/{id}', [TeacherController::class, 'destroyFeedback'])->name('feedbacks.destroy');
});



