<?php

use App\Http\Controllers\Admin\AccountController as AdminAccountController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FinanceController as AdminFinanceController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\Admin\ScheduleController as AdminScheduleController;
use App\Http\Controllers\Admin\ScheduleSessionController as AdminScheduleSessionController;
use App\Http\Controllers\Admin\ScheduleTemplateController as AdminScheduleTemplateController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;

use App\Http\Controllers\Admin\TentorController as AdminTentorController;
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
use App\Http\Controllers\Tutor\ScheduleSessionController;
use App\Http\Controllers\Tutor\ScheduleTemplateController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Support\PackagePresenter;
use App\Support\ProfileAvatar;
use App\Support\ProfileLinkResolver;
use App\Http\Controllers\Auth\GoogleController;

Route::get('/', function () {
    $catalog = collect();
    $stageDefinitions = config('mayclass.package_stages', []);

    if (Schema::hasTable('packages')) {
        $query = Package::query()->withQuotaUsage()->orderBy('level')->orderBy('price');

        if (Schema::hasTable('package_features')) {
            $query->with(['cardFeatures' => fn($features) => $features->orderBy('position')]);
        }

        $packages = $query->get();
        $catalog = PackagePresenter::groupByStage($packages);
    }

    $user = Auth::user();

    // Fetch Dynamic Content
    $hero = \App\Models\LandingContent::where('key', 'like', 'hero_%')->pluck('value', 'key');
    $articles = \App\Models\Article::latest()->take(3)->get();
    $advantages = \App\Models\Advantage::all();
    $testimonials = \App\Models\Testimonial::all();
    $mentors = \App\Models\LandingMentor::all();
    $faqs = \App\Models\Faq::all();

    return view('welcome', [
        'landingPackages' => $catalog,
        'stageDefinitions' => $stageDefinitions,
        'profileLink' => ProfileLinkResolver::forUser($user),
        'profileAvatar' => ProfileAvatar::forUser($user),
        'hero' => $hero,
        'articles' => $articles,
        'advantages' => $advantages,
        'testimonials' => $testimonials,
        'mentors' => $mentors,
        'faqs' => $faqs,
    ]);
});

Route::get('/gabung', [AuthController::class, 'join'])->name('join');

Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{slug}', [PackageController::class, 'show'])->name('packages.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::get('/lupa-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/register/details', [AuthController::class, 'storeRegisterDetails'])->name('register.details');
    Route::get('/register/password', [AuthController::class, 'showPasswordStep'])->name('register.password');
    Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
    Route::post('/register', [AuthController::class, 'register'])->name('register.perform');
    Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/checkout/{slug}', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout/{slug}', [CheckoutController::class, 'store'])->name('checkout.process');
    Route::get('/checkout/{slug}/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::post('/checkout/{slug}/orders/{order}/expire', [CheckoutController::class, 'expire'])->name('checkout.expire');
    Route::get('/checkout/{slug}/orders/{order}/status', [CheckoutController::class, 'status'])->name('checkout.status');

    Route::get('/profile', [ProfileController::class, 'show'])->name('student.profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('student.profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('student.profile.password');
});

Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::middleware('subscribed')->group(function () {
        Route::get('/jadwal', [ScheduleController::class, 'index'])->name('schedule');
        Route::get('/materi', [MaterialController::class, 'index'])->name('materials');
        Route::get('/materi/{slug}/open', [MaterialController::class, 'open'])->name('materials.open');
        Route::get('/materi/{slug}/download', [MaterialController::class, 'download'])->name('materials.download');
        Route::get('/materi/{slug}', [MaterialController::class, 'show'])->name('materials.show');
        Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');
        Route::get('/quiz/{slug}', [QuizController::class, 'show'])->name('quiz.show');
    });
});

Route::middleware(['auth', 'role:tutor'])->prefix('tutor')->name('tutor.')->group(function () {
    Route::get('/dashboard', [TutorDashboardController::class, 'index'])->name('dashboard');
    Route::get('/materi', [TutorMaterialController::class, 'index'])->name('materials.index');
    Route::get('/materi/tambah', [TutorMaterialController::class, 'create'])->name('materials.create');
    Route::post('/materi', [TutorMaterialController::class, 'store'])->name('materials.store');
    Route::get('/materi/{material:slug}/preview', [TutorMaterialController::class, 'preview'])->name('materials.preview');
    Route::get('/materi/{material:slug}/download', [TutorMaterialController::class, 'download'])->name('materials.download');
    Route::get('/materi/{material:slug}/edit', [TutorMaterialController::class, 'edit'])->name('materials.edit');
    Route::put('/materi/{material:slug}', [TutorMaterialController::class, 'update'])->name('materials.update');

    Route::get('/quiz', [TutorQuizController::class, 'index'])->name('quizzes.index');
    Route::get('/quiz/tambah', [TutorQuizController::class, 'create'])->name('quizzes.create');
    Route::post('/quiz', [TutorQuizController::class, 'store'])->name('quizzes.store');
    Route::get('/quiz/{quiz:slug}/edit', [TutorQuizController::class, 'edit'])->name('quizzes.edit');
    Route::put('/quiz/{quiz:slug}', [TutorQuizController::class, 'update'])->name('quizzes.update');
    Route::delete('/quizzes/{quiz}', [TutorQuizController::class, 'destroy'])->name('quizzes.destroy');



    Route::get('/jadwal', [TutorScheduleController::class, 'index'])->name('schedule.index');

    Route::get('/pengaturan', [TutorAccountController::class, 'edit'])->name('account.edit');
    Route::put('/pengaturan', [TutorAccountController::class, 'update'])->name('account.update');
    Route::put('/pengaturan/password', [TutorAccountController::class, 'updatePassword'])->name('account.password');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/account', [AdminAccountController::class, 'edit'])->name('account.edit');
    Route::put('/account', [AdminAccountController::class, 'update'])->name('account.update');
    Route::put('/account/password', [AdminAccountController::class, 'updatePassword'])->name('account.password');

    Route::get('/students', [AdminStudentController::class, 'index'])->name('students.index');
    Route::post('/students/bulk-delete', [AdminStudentController::class, 'bulkDelete'])->name('students.bulk-delete');
    Route::get('/students/{student}', [AdminStudentController::class, 'show'])->name('students.show');
    Route::post('/students/{student}/reset-password', [AdminStudentController::class, 'resetPassword'])->name('students.reset-password');

    Route::resource('tentors', AdminTentorController::class)->except(['show']);

    Route::get('/packages', [AdminPackageController::class, 'index'])->name('packages.index');
    Route::get('/packages/create', [AdminPackageController::class, 'create'])->name('packages.create');
    Route::post('/packages', [AdminPackageController::class, 'store'])->name('packages.store');
    Route::get('/packages/{package}/edit', [AdminPackageController::class, 'edit'])->name('packages.edit');
    Route::put('/packages/{package}', [AdminPackageController::class, 'update'])->name('packages.update');
    Route::delete('/packages/{package}', [AdminPackageController::class, 'destroy'])->name('packages.destroy');

    Route::get('/finance', [AdminFinanceController::class, 'index'])->name('finance.index');
    Route::post('/finance/{order}/approve', [AdminFinanceController::class, 'approve'])->name('finance.approve');
    Route::post('/finance/{order}/reject', [AdminFinanceController::class, 'reject'])->name('finance.reject');

    Route::get('/schedules', [AdminScheduleController::class, 'index'])->name('schedules.index');

    Route::post('/schedule/template', [AdminScheduleTemplateController::class, 'store'])->name('schedule.templates.store');
    Route::put('/schedule/template/{template}', [AdminScheduleTemplateController::class, 'update'])->name('schedule.templates.update');
    Route::delete('/schedule/template/{template}', [AdminScheduleTemplateController::class, 'destroy'])->name('schedule.templates.destroy');
    Route::put('/schedule/{session}', [AdminScheduleSessionController::class, 'update'])->name('schedule.sessions.update');
    Route::post('/schedule/{session}/cancel', [AdminScheduleSessionController::class, 'cancel'])->name('schedule.sessions.cancel');
    Route::post('/schedule/{session}/restore', [AdminScheduleSessionController::class, 'restore'])->name('schedule.sessions.restore');

    // Content Management
    Route::get('/content', [App\Http\Controllers\Admin\ContentController::class, 'index'])->name('content.index');
    Route::post('/content/hero', [App\Http\Controllers\Admin\ContentController::class, 'updateHero'])->name('content.hero.update');

    Route::post('/content/articles', [App\Http\Controllers\Admin\ContentController::class, 'storeArticle'])->name('content.articles.store');
    Route::put('/content/articles/{article}', [App\Http\Controllers\Admin\ContentController::class, 'updateArticle'])->name('content.articles.update');
    Route::delete('/content/articles/{article}', [App\Http\Controllers\Admin\ContentController::class, 'destroyArticle'])->name('content.articles.destroy');

    Route::post('/content/advantages', [App\Http\Controllers\Admin\ContentController::class, 'storeAdvantage'])->name('content.advantages.store');
    Route::put('/content/advantages/{advantage}', [App\Http\Controllers\Admin\ContentController::class, 'updateAdvantage'])->name('content.advantages.update');
    Route::delete('/content/advantages/{advantage}', [App\Http\Controllers\Admin\ContentController::class, 'destroyAdvantage'])->name('content.advantages.destroy');

    Route::post('/content/testimonials', [App\Http\Controllers\Admin\ContentController::class, 'storeTestimonial'])->name('content.testimonials.store');
    Route::put('/content/testimonials/{testimonial}', [App\Http\Controllers\Admin\ContentController::class, 'updateTestimonial'])->name('content.testimonials.update');
    Route::delete('/content/testimonials/{testimonial}', [App\Http\Controllers\Admin\ContentController::class, 'destroyTestimonial'])->name('content.testimonials.destroy');

    Route::post('/content/mentors', [App\Http\Controllers\Admin\ContentController::class, 'storeMentor'])->name('content.mentors.store');
    Route::put('/content/mentors/{mentor}', [App\Http\Controllers\Admin\ContentController::class, 'updateMentor'])->name('content.mentors.update');
    Route::delete('/content/mentors/{mentor}', [App\Http\Controllers\Admin\ContentController::class, 'destroyMentor'])->name('content.mentors.destroy');

    Route::post('/content/faqs', [App\Http\Controllers\Admin\ContentController::class, 'storeFaq'])->name('content.faqs.store');
    Route::put('/content/faqs/{faq}', [App\Http\Controllers\Admin\ContentController::class, 'updateFaq'])->name('content.faqs.update');
    Route::delete('/content/faqs/{faq}', [App\Http\Controllers\Admin\ContentController::class, 'destroyFaq'])->name('content.faqs.destroy');
});