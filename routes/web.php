<?php

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
// Views
Route::get('/', 'Controller@index');
Route::get('/adicionar', 'Controller@adicionar');
Route::get('/visualizar', 'Controller@visualizar');

// Rest
Route::get('/addItem', 'Controller@addItem');
Route::get('/getItens', 'Controller@getItens');
