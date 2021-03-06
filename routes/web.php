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

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes([
    'register' => false
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('users', 'UserController');
    Route::resource('fabricantes', 'FabricanteController');
    Route::get('fabricantes-select', 'FabricanteController@fabricantesSelect')->name('fabricantes.select');
    Route::resource('produtos', 'ProdutoController');
    Route::get('produtos-select', 'ProdutoController@produtosSelect')->name('produtos.select');
    Route::resource('clientes', 'ClienteController');
    Route::get('clientes-select', 'ClienteController@clientesSelect')->name('clientes.select');
    Route::resource('vendas', 'VendaController');
});
