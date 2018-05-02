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

Route::get('/', function () {
    return view('container/container');
});

Route::get('/categoria','CategoriaController@index');
Route::post('/categoria/registrar','CategoriaController@store');
Route::put('/categoria/actualizar','CategoriaController@update');
Route::put('/categoria/desactivar','CategoriaController@offcategoria');
Route::put('/categoria/activar','CategoriaController@oncategoria');
Route::get('/categoria/selectCategoria','CategoriaController@selectCategoria');

Route::get('/producto','ProductoController@index');
Route::post('/producto/registrar','ProductoController@store');
Route::put('/producto/actualizar','ProductoController@update');
Route::put('/producto/desactivar','ProductoController@offcategoria');
Route::put('/producto/activar','ProductoController@oncategoria');
