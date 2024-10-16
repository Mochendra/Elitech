<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ExportController;
// ...




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
// Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
//     Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
//     Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
//     Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
//     Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
//     Route::get('/archives', [ArchiveController::class, 'index'])->name('archives.index');
//     Route::post('/archives/download', [ArchiveController::class, 'download'])->name('archives.download');
// });

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register.show');
Route::post('register', [RegisterController::class, 'register'])->name('register');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/{username}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/feed', [FeedController::class, 'index'])->name('feed.index');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings/update', [SettingController::class, 'update'])->name('settings.update');
    // Route::get('/profile/{id}', [ProfileController::class, 'showProfile'])->name('profile.show'); // Menggunakan id
    Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/archives/{id}', [ArchiveController::class, 'show'])->name('archives.archives')->where('id', '[0-9]+');
    Route::get('/archives', [ArchiveController::class, 'archives'])->name('archives.archives');
    Route::post('/archives/download-all', [ArchiveController::class, 'downloadAll'])->name('archives.downloadAll');
    Route::get('/export', 'YourController@exportToExcel');
// Route::get('/export-excel', [YourController::class, 'exportToExcel']);
// Route::get('/export-archive', [ExportController::class, 'exportArchiveToExcel']);
});


// // Route for the user profile with authentication middleware
// Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');


// Halaman Login

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Halaman Registrasi
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register.show');
Route::post('register', [RegisterController::class, 'register'])->name('register');


Route::get('/feed', [FeedController::class, 'index'])->middleware('auth')->name('feed');
Route::get('/feed', [FeedController::class, 'index'])->name('feed.index');

// Rute untuk menyimpan postingan


Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');

// Halaman Profil
Route::get('/profile', function () {
    return view('profile.profile');
})->name('profile.profile');

Route::get('/profile/edit', function () {
    return view('profile.edit');
})->name('profile.edit');

// Halaman Post
Route::get('/posts', function () {
    return view('posts.posts');
})->name('posts.posts');

Route::get('/posts/create', function () {
    return view('posts.create');
})->name('posts.create');

// Halaman Pengaturan
Route::get('/settings', function () {
    return view('settings.settings');
})->name('settings.settings');

// Halaman Arsip
Route::get('/archives', function () {
    return view('archives.archives');
})->name('archives.archives');