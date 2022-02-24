<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemontypeController;
use App\Http\Controllers\PokemonabilityController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\UserController;

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

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('firstpage.firstpage');
});

Route::resource('pokemontype', PokemontypeController::class);

Route::resource('pokemonability', PokemonabilityController::class);

Route::resource('pokemon', PokemonController::class);

Route::get('/base', [App\Http\Controllers\HomeController::class, 'index'])->name('base.base');

Route::get('/pokemon', [PokemonController::class, 'index'])->name('pokemon');

Route::get('/perfil', [UserController::class, 'useredit']);

Route::resource('user', UserController::class);

Route::put('user', [UserController::class, 'userupdate'])->name('user.userupdate');