<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\PdfCategoryController;
use App\Http\Controllers\PdfBookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ==================== AUTH ROUTES ====================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ==================== PUBLIC ROUTES ====================
Route::get('/', function () {
    return view('home');
})->name('home')->middleware('auth');

// ==================== PROTECTED RESOURCE ROUTES ====================
Route::middleware(['auth'])->group(function () {

    // PDF Books management
    Route::get('/pdf-books/most-downloaded', [PdfBookController::class, 'mostDownloaded'])
        ->name('pdf-books.most-downloaded');

    Route::get('/pdf-books/most-viewed', [PdfBookController::class, 'mostViewed'])
        ->name('pdf-books.most-viewed');

    Route::resource('pdf-books', PdfBookController::class);
    Route::get('pdf-books/{pdfBook}/download', [PdfBookController::class, 'download'])
        ->name('pdf-books.download');

    // ==================== ADMIN ONLY ROUTES ====================
    Route::middleware('admin')->group(function () {

        // Backup Management Routes
        Route::prefix('backup')->name('backup.')->group(function () {
            Route::get('/', [BackupController::class, 'index'])->name('index');
            Route::post('/create', [BackupController::class, 'createBackup'])->name('create');
            Route::get('/download/{filename}', [BackupController::class, 'downloadBackup'])->name('download');
            Route::delete('/delete/{filename}', [BackupController::class, 'deleteBackup'])->name('delete');
        });
        // Categories management - ត្រូវប្រាកដថាមាននេះ
        Route::resource('pdf-categories', PdfCategoryController::class);

        // Reset routes for PDF Books (admin only)
        Route::post('/pdf-books/{pdfBook}/reset-downloads', [PdfBookController::class, 'resetDownloads'])
            ->name('pdf-books.reset-downloads');

        Route::post('/pdf-books/{pdfBook}/reset-userviews', [PdfBookController::class, 'resetUserViews'])
            ->name('pdf-books.reset-userviews');
    });
});

// User Management Routes (Admin only - you should add middleware as needed)
Route::middleware(['auth'])->prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{id}', [UserController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');

    // Additional routes
    Route::post('/{id}/verify-email', [UserController::class, 'verifyEmail'])->name('web-verify-email');
    Route::post('/{id}/resend-verification', [UserController::class, 'resendVerification'])->name('resend-verification');
});
