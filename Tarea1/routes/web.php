<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pag2Controller;

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


Route::post('/Pag2',[Pag2Controller::class, 'store'])->name('Pag2'); //Ruta necesaria para enviar la cantidad vertices a la siguiente pag
Route::view('/','home')->name('Home');
Route::post('/paw2', [Pag2Controller::class, 'store2'])->name('paw2x');
Route::post('/paw3',[Pag2Controller::class, 'store3'])->name('paw3');
Route::post('/paw4',[Pag2Controller::class,'storage'])->name('paw4');
Route::post('/paw5',[Pag2Controller::class,'storage2'])->name('paw5');

