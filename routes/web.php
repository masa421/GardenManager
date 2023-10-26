<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\PlantController;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\GardenController;
use App\Http\Controllers\LocationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ===== Location =====

// Add Location (post)
Route::post('/location', [LocationController::class, 'store'])->middleware('auth');

// Lost Locations
Route::get('/locations', [LocationController::class, 'index'])->middleware('auth');

// Add Location (show form)
Route::get('/location/add', [LocationController::class, 'add'])->middleware('auth');

// ===== Garden ======

// Create new Garden (post)
Route::post('/garden', [GardenController::class, 'store'])->middleware('auth');

// Create Garden (show form)
Route::get('/garden/create/{location}', [GardenController::class, 'create'])->middleware('auth');

// Update Garden (post)
Route::put('/garden/{garden}', [GardenController::class, 'update'])->middleware('auth');

// List Gardens
Route::get('/location/{location}/gardens', [GardenController::class, 'list'])->middleware('auth');

// Edit gatden (show form)
Route::get('/garden/{garden}/edit', [GardenController::class, 'edit'])->middleware('auth');

// Show Garden detail
Route::get('/garden/{garden}', [GardenController::class, 'show'])->middleware('auth');

// Block for /garden access
Route::get('/garden', function () {return abort(404, 'Not found');})->middleware('auth');


// ===== User =====

// Show Register.Create Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Show Login Form
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');


// ===== Plant =====

// Delete Plant
Route::delete('/plant/{plant}/delete', [PlantController::class, 'delete'])->middleware('auth');

// Edit Plant
Route::post('/plant', [PlantController::class, 'store'])->middleware('auth');

// Edit Plant
Route::get('/plant/{plant}/edit', [PlantController::class, 'edit'])->middleware('auth');

// Update Plant
Route::put('/plant/{plant}', [PlantController::class, 'update'])->middleware('auth');

// Edit Plant
Route::get('/plant/{garden}/add', [PlantController::class, 'add'])->middleware('auth');


// ===== Welcome =====

Route::get('/', function () {return view('welcome');});

Route::get('/about', function () {return view('about');});

Route::get('/contact', function () {return view('contact');});

Route::get('/test', [GardenController::class, 'test'])->middleware('auth');


// ===== Auth =====

// Password Reset
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');


Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');


Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');