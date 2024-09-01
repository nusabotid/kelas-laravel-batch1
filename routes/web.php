<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\SensorController;
use App\Http\Middleware\AuthCheck;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ArticleController;

Route::middleware(AuthCheck::class)->group(function () {
    Route::get('/sensor', [SensorController::class, 'index']);
    Route::get('/sensor/create', [SensorController::class, 'create']);
    Route::get('/sensor/edit/{id}', [SensorController::class, 'edit']);
    Route::post('/sensor/store', [SensorController::class, 'store']);
    Route::put('/sensor/update/{id}', [SensorController::class, 'update']);
    Route::delete('/sensor/delete/{id}', [SensorController::class, 'delete']);
});

Route::middleware(IsAdmin::class)->group(function () {
    Route::get('/device', [DeviceController::class, 'index']);
    Route::get('/device/create', [DeviceController::class, 'create']);
    Route::get('/device/edit/{id}', [DeviceController::class, 'edit']);
    Route::post('/device/store', [DeviceController::class, 'store']);
    Route::put('/device/update/{id}', [DeviceController::class, 'update']);
    Route::delete('/device/delete/{id}', [DeviceController::class, 'delete']);
});

// Route::get('/login', [AuthController::class, 'viewLogin']);
// Route::get('/register', [AuthController::class, 'viewRegister']);
Route::get('/ganti-password', [AuthController::class, 'viewChangePassword']);
Route::post('/ganti-password', [AuthController::class, 'changePassword']);























// Route::get('/as', function () {
//     $username = 'Figo';
//     if ($username === 'Figo') {
//         echo 'Halo Figo';
//     } else {
//         echo 'Bukan' . $username;

//     }
// });

// Route::post('/article/create/', function () {
//     $article = [
//         'title' => request('title'),
//         'description' => request('description'),
//         'slug' => request('slug'),
//     ];

//     return $article;
// });

// Route::get('/about', function () {
//     $sort = request('sort');
//     $page = request('page');

//     return $sort . ' Halaman ' . $page;
// });

// Route::get('/article', [ArticleController::class, 'index']);
// Route::get('/article/detail/{slug}', [ArticleController::class, 'show']);
