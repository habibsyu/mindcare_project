<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\CounselingController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');

// Content routes (public)
Route::prefix('content')->name('content.')->group(function () {
    Route::get('/', [ContentController::class, 'index'])->name('index');
    Route::get('/categories', [ContentController::class, 'categories'])->name('categories');
    Route::get('/category/{category}', [ContentController::class, 'category'])->name('category');
    Route::get('/{content:slug}', [ContentController::class, 'show'])->name('show');
});

// Blog routes (public)
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/category/{category}', [BlogController::class, 'category'])->name('category');
    Route::get('/tag/{tag}', [BlogController::class, 'tag'])->name('tag');
    Route::get('/{blog:slug}', [BlogController::class, 'show'])->name('show');
});

// Community routes (public)
Route::prefix('community')->name('community.')->group(function () {
    Route::get('/', [CommunityController::class, 'index'])->name('index');
    Route::get('/redirect/{link}', [CommunityController::class, 'redirect'])->name('redirect');
});

// Authentication routes
require __DIR__.'/auth.php';

// Authenticated routes
Route::middleware('auth')->group(function () {
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Assessment routes
    Route::prefix('assessments')->name('assessments.')->group(function () {
        Route::get('/', [AssessmentController::class, 'index'])->name('index');
        Route::get('/dashboard', [AssessmentController::class, 'dashboard'])->name('dashboard');
        Route::get('/{type}', [AssessmentController::class, 'show'])->name('show');
        Route::get('/{type}/take', [AssessmentController::class, 'take'])->name('take');
        Route::post('/{type}/submit', [AssessmentController::class, 'submit'])->name('submit');
        Route::get('/result/{assessment}', [AssessmentController::class, 'result'])->name('result');
    });
    
    // Content interaction routes
    Route::prefix('content')->name('content.')->group(function () {
        Route::post('/{content}/like', [ContentController::class, 'like'])->name('like');
        Route::post('/{content}/bookmark', [ContentController::class, 'bookmark'])->name('bookmark');
        Route::post('/{content}/share', [ContentController::class, 'share'])->name('share');
    });
    
    // Counseling routes
    Route::prefix('counseling')->name('counseling.')->group(function () {
        Route::get('/', [CounselingController::class, 'index'])->name('index');
        Route::get('/start', [CounselingController::class, 'start'])->name('start');
        Route::get('/chat/{sessionId}', [CounselingController::class, 'chat'])->name('chat');
        Route::post('/chat/{sessionId}/message', [CounselingController::class, 'sendMessage'])->name('send-message');
        Route::post('/chat/{sessionId}/request-human', [CounselingController::class, 'requestHumanTransfer'])->name('request-human');
        Route::post('/chat/{sessionId}/end', [CounselingController::class, 'endSession'])->name('end');
        Route::post('/chat/{sessionId}/rate', [CounselingController::class, 'rateSession'])->name('rate');
        Route::get('/history', [CounselingController::class, 'history'])->name('history');
    });
});

// Admin routes
Route::middleware(['auth', 'role:admin,staff'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // User Management (Admin only)
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
        Route::resource('staff', App\Http\Controllers\Admin\StaffController::class);
    });
    
    // Content Management
    Route::resource('contents', App\Http\Controllers\Admin\ContentController::class);
    Route::resource('blogs', App\Http\Controllers\Admin\BlogController::class);
    Route::resource('community-links', App\Http\Controllers\Admin\CommunityLinkController::class);
    
    // Assessment Management
    Route::get('/assessments', [App\Http\Controllers\Admin\AssessmentController::class, 'index'])->name('assessments.index');
    Route::get('/assessments/{assessment}', [App\Http\Controllers\Admin\AssessmentController::class, 'show'])->name('assessments.show');
    
    // Counseling Management
    Route::get('/counseling', [App\Http\Controllers\Admin\CounselingController::class, 'index'])->name('counseling.index');
    Route::get('/counseling/{session}', [App\Http\Controllers\Admin\CounselingController::class, 'show'])->name('counseling.show');
    Route::post('/counseling/{session}/take-over', [App\Http\Controllers\Admin\CounselingController::class, 'takeOver'])->name('counseling.take-over');
    
    // Settings
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});