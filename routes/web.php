<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CallController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/app', [CallController::class, 'index'])->name('index');

// Аутентификация
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/reg', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/reg', [RegisterController::class, 'register'])->name('register.submit');

// Маршруты для управления звонками
Route::get('/calls', [CallController::class, 'index'])->name('calls.index');
Route::get('/calls/create', [CallController::class, 'create'])->name('calls.create');
Route::post('/calls', [CallController::class, 'store'])->name('calls.store');

// Статические маршруты должны быть определены до динамических
Route::get('/calls/report', [CallController::class, 'report'])->name('calls.report');
Route::get('/calls/report/download', [CallController::class, 'downloadReport'])->name('calls.report.download');

Route::get('/calls/audio/{audio_file}', [CallController::class, 'getAudio'])->name('calls.audio');
Route::get('/calls/download/{audio_file}', [CallController::class, 'downloadAudio'])->name('calls.download');
Route::post('/calls/upload-file', [CallController::class, 'uploadFile'])->name('calls.upload-file');

// Динамические маршруты с параметром должны быть в конце
Route::get('/calls/{call}', [CallController::class, 'show'])->name('calls.show');
Route::get('/calls/{call}/edit', [CallController::class, 'edit'])->name('calls.edit');
Route::put('/calls/{call}', [CallController::class, 'update'])->name('calls.update');
Route::delete('/calls/{call}', [CallController::class, 'destroy'])->name('calls.destroy');


Route::get('/conversations', 'ConversationController@index')->name('conversations.index');
