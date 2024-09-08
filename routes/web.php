<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\SensorController;
use App\Http\Middleware\AuthCheck;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ArticleController;

Route::middleware('auth-check')->group(function ($router) {
    $router->get('/', [DashboardController::class, 'index']);

    $router->controller(SensorController::class)->group(function ($subrouter) {
        $subrouter->get('/sensor', 'index');
        $subrouter->get('/sensor/create', 'create');
        $subrouter->get('/sensor/edit/{id}', 'edit');
        $subrouter->post('/sensor/store', 'store');
        $subrouter->put('/sensor/update/{id}', 'update');
        $subrouter->delete('/sensor/delete/{id}', 'delete');
    });
});

Route::middleware('is-admin')->group(function ($router) {
    $router->controller(DeviceController::class)->group(function ($subrouter) {
        $subrouter->get('/device', 'index');
        $subrouter->get('/device/create', 'create');
        $subrouter->get('/device/edit/{id}', 'edit');
        $subrouter->post('/device/store', 'store');
        $subrouter->put('/device/update/{id}', 'update');
        $subrouter->delete('/device/delete/{id}', 'delete');
    });
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
