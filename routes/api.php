<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BackupApiController;
use App\Http\Controllers\API\ChatController;
use App\Http\Controllers\API\ChatMemberController;
use App\Http\Controllers\API\ChatMessageController;
use App\Http\Controllers\Api\PdfBookApiController;
use App\Http\Controllers\API\UserApiController;
use App\Http\Controllers\GoogleAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group.
|
*/

// =========================================================================
// PUBLIC ROUTES (No Authentication Required)
// =========================================================================

Route::post('/signup', [AuthController::class, 'signup']);
// User Login
Route::post('/signin', [AuthController::class, 'signin']);
// Email Verification
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
    ->middleware('signed')
    ->name('verify.email');
// Resend Verification Email (with rate limiting: 3 attempts per minute)
Route::post('/email/verify/resend', [AuthController::class, 'resendVerificationMail'])
    ->middleware('throttle:3,1');
// Password Reset - Request reset link
Route::post('/password/forgot', [AuthController::class, 'sendResetPasswordMail']);
// Password Reset - Set new password
Route::post('/password/reset', [AuthController::class, 'setNewPassword'])
    ->name('reset.password');
/*
    |--------------------------------------------------------------------------
    | Google OAuth Routes
    |--------------------------------------------------------------------------
    */
// Redirect to Google for authentication
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle']);

// Google OAuth callback URL
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
// =========================================================================
// PROTECTED ROUTES (Sanctum Authentication Required)
// =========================================================================
Route::middleware('auth:sanctum')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | API Version 1 (v1) Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('v1')->name('api.')->group(function () {

        /*
        |----------------------------------------------------------------------
        | PDF Books - Public Read Operations
        |----------------------------------------------------------------------
        */

        // Get all PDF books (with filters & pagination)
        Route::get('/pdf-books', [PdfBookApiController::class, 'index'])
            ->name('pdf-books.index');

        // Get single PDF book details
        Route::get('/pdf-books/{id}', [PdfBookApiController::class, 'show'])
            ->name('pdf-books.show');

        // Download PDF file
        Route::get('/pdf-books/{id}/download', [PdfBookApiController::class, 'download'])
            ->name('pdf-books.download');

        /*
        |----------------------------------------------------------------------
        | Categories Routes
        |----------------------------------------------------------------------
        */

        // Get all categories (for dropdown/filter)
        Route::get('/categories', [PdfBookApiController::class, 'getCategories'])
            ->name('categories.index');

        // Get all books by category
        Route::get('/categories/{categoryId}/books', [PdfBookApiController::class, 'getByCategory'])
            ->name('categories.books');

        /*
        |----------------------------------------------------------------------
        | PDF Books - Protected Write Operations (Requires Authentication)
        |----------------------------------------------------------------------
        */

        // Create new PDF book
        Route::post('/pdf-books', [PdfBookApiController::class, 'store'])
            ->name('pdf-books.store');

        // Update existing PDF book
        Route::put('/pdf-books/{id}', [PdfBookApiController::class, 'update'])
            ->name('pdf-books.update');

        // Delete PDF book
        Route::delete('/pdf-books/{id}', [PdfBookApiController::class, 'destroy'])
            ->name('pdf-books.destroy');

        // Toggle book active/inactive status
        Route::patch('/pdf-books/{id}/toggle-status', [PdfBookApiController::class, 'toggleStatus'])
            ->name('pdf-books.toggle-status');
    });

    /*
    |--------------------------------------------------------------------------
    | Authenticated User Management
    |--------------------------------------------------------------------------
    */

    // User logout (invalidate current token)
    Route::post('/signout', [AuthController::class, 'signout']);

    // Refresh authentication token
    Route::patch('/token/refresh', [AuthController::class, 'refreshToken']);

    // Verify current user account status
    Route::get('/verify/account', [AuthController::class, 'verifyAccount']);

    // Change user password
    Route::patch('/password/change', [AuthController::class, 'changePassword']);

    // Create password for OAuth users
    Route::patch('/password/create', [AuthController::class, 'createPassword']);

    // Update user profile photo
    Route::patch('/update/photo', [AuthController::class, 'updateUserPhoto']);

    /*
    |--------------------------------------------------------------------------
    | User API Routes
    |--------------------------------------------------------------------------
    */

    // Get list of users (public info)
    Route::prefix('users_api')->group(function () {
        Route::get('/', [UserApiController::class, 'getUsers']);
    });

    /*
    |--------------------------------------------------------------------------
    | Chat System Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('chats')->group(function () {

        /*
        |----------------------------------------------------------------------
        | Chat Management
        |----------------------------------------------------------------------
        */

        // Get all user chats
        Route::get('/', [ChatController::class, 'getChats']);

        // Create new chat
        Route::post('/create', [ChatController::class, 'createChat']);

        // Get single chat details
        Route::get('/read/{chatId}', [ChatController::class, 'readChat']);

        // Update group chat
        Route::patch('/update/{chatId}', [ChatController::class, 'updateGroupChat']);

        // Delete group chat
        Route::delete('/delete/{chatId}', [ChatController::class, 'deleteGroupChat']);

        // Leave group chat
        Route::post('/leave/{chatId}', [ChatController::class, 'leaveGroupChat']);

        // Read chat file attachment
        Route::get('/read/{chatId}/{folder}/{filename}', [ChatController::class, 'readChatFile']);

        /*
        |----------------------------------------------------------------------
        | Chat Messages
        |----------------------------------------------------------------------
        */

        // Get all messages in a chat
        Route::get('/{chatId}/messages', [ChatMessageController::class, 'getMessages']);

        // Create new message
        Route::post('/{chatId}/messages/create', [ChatMessageController::class, 'createMessage']);

        // Update message
        Route::patch('/{chatId}/messages/update/{messageId}', [ChatMessageController::class, 'updateMessage']);

        // Delete message
        Route::delete('/{chatId}/messages/delete/{messageId}', [ChatMessageController::class, 'deleteMessage']);

        // Mark message as seen
        Route::post('/{chatId}/messages/seen/{messageId}', [ChatMessageController::class, 'markMessageAsSeen']);

        // Mark all messages in chat as seen
        Route::post('/{chatId}/messages/seen-all', [ChatMessageController::class, 'markAllMessagesAsSeen']);

        /*
        |----------------------------------------------------------------------
        | Chat Members
        |----------------------------------------------------------------------
        */

        // Get all members in a chat
        Route::get('/{chatId}/members', [ChatMemberController::class, 'getMembers']);

        // Add member to chat
        Route::post('/{chatId}/members/add', [ChatMemberController::class, 'addMember']);

        // Update member role/permissions
        Route::patch('/{chatId}/members/update/{memberId}', [ChatMemberController::class, 'updateMember']);

        // Remove member from chat
        Route::delete('/{chatId}/members/remove/{memberId}', [ChatMemberController::class, 'removeMember']);
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY ROUTES (Requires admin middleware)
    |--------------------------------------------------------------------------
    */
    Route::middleware('admin')->group(function () {

        /*
        |----------------------------------------------------------------------
        | Backup Management
        |----------------------------------------------------------------------
        */

        Route::prefix('backups_api')->group(function () {

            // Get all backups
            Route::get('/', [BackupApiController::class, 'getBackups']);

            // Create new backup
            Route::post('/create', [BackupApiController::class, 'createBackup']);

            // Download backup file
            Route::get('/download/{filename}', [BackupApiController::class, 'downloadBackup']);

            // Delete backup file
            Route::delete('/delete/{filename}', [BackupApiController::class, 'deleteBackup']);
        });

        /*
        |----------------------------------------------------------------------
        | Admin User Management (Full CRUD)
        |----------------------------------------------------------------------
        */

        Route::prefix('manage')->group(function () {

            Route::prefix('users_api')->group(function () {

                // Get all users with details (admin view)
                Route::get('/', [UserApiController::class, 'getDetailUsers']);

                // Get single user details
                Route::get('/read/{id}', [UserApiController::class, 'readDetailUser']);

                // Create new user
                Route::post('/create', [UserApiController::class, 'createUser']);

                // Update user
                Route::put('/update/{id}', [UserApiController::class, 'updateUser']);

                // Delete user
                Route::delete('/delete/{id}', [UserApiController::class, 'deleteUser']);
            });
        });
    });
});
