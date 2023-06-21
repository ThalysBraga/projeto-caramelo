<?php

use Illuminate\Http\Request;
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

Route::get('/login', function (Request $request) {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::get('/logout', [Controllers\LoginController::class, 'logout'])->middleware('auth');

Route::get('/', function () {
    return redirect('animais.index');
})->middleware('auth');

/**
 * Animais
 */

$controller = App\Http\Controllers\AnimaisController::class;
Route::get('/animais', [$controller,'index'])->name('animais.index');
Route::get('/animais/create', [$controller,'create'])->name('animais.create');
Route::post('/animais', [$controller,'store'])->name('animais.store')->middleware('auth');
Route::get('/animais/edit/{animal}', [$controller,'edit'])->name('animais.edit')->middleware('auth');
Route::post('/animais/update/{animal}', [$controller,'update'])->name('animais.update')->middleware('auth');
Route::post('/animais/destroy/{animal}', [$controller,'destroy'])->name('animais.destroy')->middleware('auth');

/**
 * Usuarios
 */

$controller = App\Http\Controllers\UsuariosController::class;

Route::get('/usuario/visualizar-animais', [$controller,'indexAnimais'])->name('usuario.indexAnimais')->middleware('auth');
Route::get('/usuario/create', [$controller,'create'])->name('usuario.create');
Route::post('/usuario/store', [$controller,'store'])->name('usuario.store');
Route::get('/usuario/edit/{usuario}', [$controller,'edit'])->name('usuario.edit')->middleware('auth');
Route::post('/usuario/update/{usuario}', [$controller,'update'])->name('usuario.update')->middleware('auth');

