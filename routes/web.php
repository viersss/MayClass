<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FinanceController as AdminFinanceController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\MaterialController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\QuizController;
use App\Http\Controllers\Student\ScheduleController;
use App\Http\Controllers\Tutor\AccountController as TutorAccountController;
use App\Http\Controllers\Tutor\DashboardController as TutorDashboardController;
use App\Http\Controllers\Tutor\MaterialController as TutorMaterialController;
use App\Http\Controllers\Tutor\QuizController as TutorQuizController;
use App\Http\Controllers\Tutor\ScheduleController as TutorScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/gabung', [AuthController::class, 'join'])->name('join');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
    Route::post('/register', [AuthController::class, 'register'])->name('register.perform');

});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
    Route::get('/packages/{slug}', [PackageController::class, 'show'])->name('packages.show');

    Route::get('/checkout/{slug}', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout/{slug}', [CheckoutController::class, 'store'])->name('checkout.process');
    Route::get('/checkout/{slug}/success', [CheckoutController::class, 'success'])->name('checkout.success');
});

Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::middleware('subscribed')->group(function () {
        Route::get('/jadwal', [ScheduleController::class, 'index'])->name('schedule');
        Route::get('/materi', [MaterialController::class, 'index'])->name('materials');
        Route::get('/materi/{slug}', [MaterialController::class, 'show'])->name('materials.show');
        Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');
        Route::get('/quiz/{slug}', [QuizController::class, 'show'])->name('quiz.show');
    });
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'role:tutor'])->prefix('tutor')->name('tutor.')->group(function () {
    Route::get('/dashboard', [TutorDashboardController::class, 'index'])->name('dashboard');
    Route::get('/materi', [TutorMaterialController::class, 'index'])->name('materials.index');
    Route::get('/materi/tambah', [TutorMaterialController::class, 'create'])->name('materials.create');
    Route::post('/materi', [TutorMaterialController::class, 'store'])->name('materials.store');
    Route::get('/materi/{material:slug}/edit', [TutorMaterialController::class, 'edit'])->name('materials.edit');
    Route::put('/materi/{material:slug}', [TutorMaterialController::class, 'update'])->name('materials.update');

    Route::get('/quiz', [TutorQuizController::class, 'index'])->name('quizzes.index');
    Route::get('/quiz/tambah', [TutorQuizController::class, 'create'])->name('quizzes.create');
    Route::post('/quiz', [TutorQuizController::class, 'store'])->name('quizzes.store');
    Route::get('/quiz/{quiz:slug}/edit', [TutorQuizController::class, 'edit'])->name('quizzes.edit');
    Route::put('/quiz/{quiz:slug}', [TutorQuizController::class, 'update'])->name('quizzes.update');

    Route::get('/jadwal', [TutorScheduleController::class, 'index'])->name('schedule.index');

    Route::get('/pengaturan', [TutorAccountController::class, 'edit'])->name('account.edit');
    Route::put('/pengaturan', [TutorAccountController::class, 'update'])->name('account.update');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/students', [AdminStudentController::class, 'index'])->name('students.index');
    Route::get('/students/{student}', [AdminStudentController::class, 'show'])->name('students.show');

    Route::get('/packages', [AdminPackageController::class, 'index'])->name('packages.index');
    Route::get('/packages/create', [AdminPackageController::class, 'create'])->name('packages.create');
    Route::post('/packages', [AdminPackageController::class, 'store'])->name('packages.store');
    Route::get('/packages/{package}/edit', [AdminPackageController::class, 'edit'])->name('packages.edit');
    Route::put('/packages/{package}', [AdminPackageController::class, 'update'])->name('packages.update');
    Route::delete('/packages/{package}', [AdminPackageController::class, 'destroy'])->name('packages.destroy');

    Route::get('/finance', [AdminFinanceController::class, 'index'])->name('finance.index');
    Route::post('/finance/{order}/approve', [AdminFinanceController::class, 'approve'])->name('finance.approve');
    Route::post('/finance/{order}/reject', [AdminFinanceController::class, 'reject'])->name('finance.reject');
});
