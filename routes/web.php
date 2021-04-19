<?php

use Illuminate\Support\Facades\Route;

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


Route::get('login', function(){
    return view('login.login');
})->name('login');
Route::post('login', [\App\Http\Controllers\login\loginController::class, 'login']);

Route::get('register', function(){
    return view('login.register');
})->name('register');
Route::post('register', [\App\Http\Controllers\login\loginController::class, 'register']);

Route::middleware(['logged'])->group(function(){
    Route::get('/', function () {
        return view('welcome');
    });

    Route::group([
        'prefix'=>'admin'
    ],function ($router) {
        // Route::get('/users', [\App\Http\Controllers\login\LoginController::class, 'users']);
        Route::get('/cotacoes', [\App\Http\Controllers\CotacoesController::class, 'index']);
        Route::get('/convert/{moeda}', [\App\Http\Controllers\CotacoesController::class, 'convert']);
    });
});


