<?php

use App\Http\Controllers\SensorController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ArticleController;

Route::get('/sensor', [SensorController::class, 'index']);
Route::get('/sensor/create', [SensorController::class, 'create']);
Route::get('/sensor/edit/{id}', [SensorController::class, 'edit']);
Route::post('/sensor/store', [SensorController::class, 'store']);
Route::put('/sensor/update/{id}', [SensorController::class, 'update']);
Route::delete('/sensor/delete/{id}', [SensorController::class, 'delete']);























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
