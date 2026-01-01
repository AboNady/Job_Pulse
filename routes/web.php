<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\{
    JobController,
    TagController,
    SearchController,
    EmployerController,
    ChartsController,
    SessionController,
    RegisteredUserController,
    UserController,
    Dashboard,
    PasswordResetController,
    ChatController
};
use App\Models\Employer;
use App\Models\Job;
use App\Services\VectorService;

// ============================================================================
// PUBLIC ROUTES (No authentication required)
// ============================================================================
Route::get('/test-speed', function() {
    return 'Fast?';
});

Route::get('/runq', function () {
    // 1. Run the worker only for pending jobs, then stop
    // This prevents the server from timing out
    Artisan::call('queue:work', [
        '--stop-when-empty' => true,
        '--tries' => 3
    ]);

    // 2. Show the output so you know what happened
    return '<pre>' . Artisan::output() . '</pre>';
});

Route::get('/optimize-app', function () {
    try {
                
        // 1. Clear everything first
        \Artisan::call('optimize:clear');
        $clear = \Artisan::output();


        // 3. Cache Views (For page load speed)
        \Artisan::call('view:cache');
        $view = \Artisan::output();
        
        // Note: We intentionally SKIP 'route:cache' because it fails
        // when using closure-based routes like this one.

        return '<pre>SUCCESS!<br>' .
               '------------------<br>' .
               $clear . 
               $view . 
               '</pre>';
               
    } catch (\Exception $e) {
        return 'ERROR: ' . $e->getMessage();
    }
});
Route::post('/boring', ChatController::class)->name('chat.ask');

Route::get('/', [JobController::class, 'index'])->name('index');
Route::get('search', SearchController::class)->name('search');
Route::get('job/{job}', [JobController::class, 'show'])->name('job.show');

Route::get('careers', fn() => view('main.careers'))->name('careers');
Route::get('salaries', [ChartsController::class, 'salaries'])->name('salaries');

Route::get('companies', [EmployerController::class, 'index'])->name('companies.index');
Route::get('companies/{employer}', function ($employer) {
    $company = Employer::findOrFail($employer);
    return view('companies.show', ['company' => $company]);
})->name('companies.show');

Route::get('tags/{tag:name}', [TagController::class,'search'])->name('tags');

// ============================================================================
// AUTHENTICATION ROUTES (Guests only)
// ============================================================================

Route::middleware('guest')->group(function () {
    
    // 1. Show "Forgot Password" form
    Route::get('/forgot-password', [PasswordResetController::class, 'create'])
        ->name('password.request');

    // 2. Handle form submission (Send Email)
    Route::post('/forgot-password', [PasswordResetController::class, 'store'])
        ->name('password.email');

    // 3. Show "Reset Password" form (User clicks email link to get here)
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'edit'])
        ->name('password.reset');

    // 4. Handle the actual password update
    Route::post('/reset-password', [PasswordResetController::class, 'update'])
        ->name('password.update');

    // Registration
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store'])->name('registerp');

    // Login
    Route::get('login', [SessionController::class, 'create'])->name('login');
    Route::post('login', [SessionController::class, 'store'])->name('loginp');
});

// ============================================================================
// EMAIL VERIFICATION ROUTES (Authenticated only)
// ============================================================================

Route::middleware('auth')->group(function () {
    
    // Show verification notice
    Route::get('email/verify', function () {
        return view('mail.reverify-email',);
    })->name('verification.notice');

    // Verify email with signed URL
    Route::get('email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/dashboard')->with('success', 'Email verified!');
    })->middleware(['signed'])->name('verification.verify');

    // Resend verification email
    Route::post('email/resend', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification email sent.');
    })->middleware(['throttle:6,1'])->name('verification.send');

    
    // Logout
    Route::post('logout', [SessionController::class, 'destroy'])->name('logout');

});

// ============================================================================
// AUTHENTICATED ROUTES (Auth + Verified)
// ============================================================================

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('dashboard', [Dashboard::class, 'index'])->name('dashboard');

    // ========================================================================
    // User Account Routes
    // ========================================================================

    Route::prefix('dashboard/settings')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'settingsForm'])->name('settings');
        Route::put('/', [UserController::class, 'updateSettings'])->name('settings.update');
        Route::put('password', [UserController::class, 'updatePassword'])->name('password.update');
    });

    // ========================================================================
    // Job Management Routes
    // ========================================================================

    Route::prefix('dashboard/jobs')->name('jobs.')->controller(JobController::class)->group(function () {
        Route::get('/', [Dashboard::class, 'manage'])->name('manage');
        Route::get('create', 'create')->name('create');
        Route::post('create', 'store')->name('store');
        Route::get('{job}/edit', 'edit')->name('edit');
        Route::patch('{job}/update', 'update')->name('update');
        Route::delete('{job}/delete', 'destroy')->name('delete');
    });

    // ========================================================================
    // Tag Management Routes
    // ========================================================================

    Route::prefix('dashboard/tags')->name('tags.')->controller(TagController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('{tag}/edit', 'edit')->name('edit');
        Route::patch('{tag}/update', 'update')->name('update');
        Route::delete('{tag}/delete', 'destroy')->name('delete');
    });

    // ========================================================================
    // Company Management Routes
    // ========================================================================

    Route::prefix('companies')->name('companies.')->group(function () {
        Route::patch('{employer}/update', [EmployerController::class, 'update'])->name('update');
    });

});
