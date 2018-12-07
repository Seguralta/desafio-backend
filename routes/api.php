<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('authapi')->get('/user', 'User@index');
Route::middleware('authapi')->get('/user/{id}', 'User@read');
Route::middleware('authapi')->post('/user', 'User@create');
Route::middleware('authapi')->post('/user/{id}', 'User@advice');
Route::middleware('authapi')->put('/user/{id}', 'User@update'); // Aqui foi utilizado o PUT ao invés do POST (pedido no desafio) para ficar no padrão REST
Route::middleware('authapi')->delete('/user/{id}', 'User@delete');
