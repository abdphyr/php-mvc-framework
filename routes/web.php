<?php
namespace app\routes;

use Abd\Mvc\Router\Route;
use App\Controllers\AuthController;
use App\Controllers\SiteController;

Route::get('/', [SiteController::class, 'home']);
Route::get('/contact', [SiteController::class, 'contact'])->name("contact");
Route::get('/api', [SiteController::class, 'api'])->name("api-master");
Route::post('/contact', [SiteController::class, 'handleContact']);

Route::get('/profile', [AuthController::class, 'profile'])->name("user-profile");
Route::get('/login', [AuthController::class, 'loginView']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerView']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);
