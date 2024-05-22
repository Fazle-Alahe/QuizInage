<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';


// Authentication
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/store/registration', [HomeController::class, 'store_registration'])->name('store.registration');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/attempt/login', [HomeController::class, 'attempt_login'])->name('attempt.login');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
});

// Quiz
Route::get('/quiz/page', [QuizController::class, 'quiz_page'])->name('quiz.page');
Route::post('/quiz/store', [QuizController::class, 'quiz_store'])->name('quiz.store');
Route::get('/quiz/participate', [QuizController::class, 'quiz_participate'])->name('quiz.participate');
Route::post('/quiz/answer/{id}', [QuizController::class, 'quiz_answer'])->name('quiz.answer');

Route::get('/quiz/answers/{id}', [QuizController::class, 'quiz_answers'])->name('quiz.answers');
Route::get('/best/answers/{id}', [QuizController::class, 'best_answers'])->name('best.answers');
