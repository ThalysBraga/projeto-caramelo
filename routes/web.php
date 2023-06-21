<?php

use Illuminate\Support\Facades\Route;

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

/**
 * Usuarios
 */

$controller = App\Http\Controllers\UsuariosController::class;


Route::get('/cadastro/create', [$controller,'create'])->name('cadastro.create');
Route::post('/cadastro/store', [$controller,'store'])->name('cadastro.store');

