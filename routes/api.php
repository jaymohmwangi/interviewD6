<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'middleware' => [],
    'namespace' => 'App\Http\Controllers\Api',
    'prefix' => '/customer'
], function ($router) {
    Route:: get('/{id}', 'CustomersController@find')->name("find.customer");
});
Route::group([
    'middleware' => [],
    'namespace' => 'App\Http\Controllers\Api',
    'prefix' => '/invoice'
], function ($router) {
    Route:: post('/store', 'InvoicesController@store')->name("store.invoice");
});
