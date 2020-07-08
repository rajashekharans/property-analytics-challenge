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

Route::post('properties', 'PropertyController@addProperty')
    ->name('api.add-property');
Route::put('properties/{property_id}/property-analytic', 'PropertyController@addUpdatePropertyAnalytic')
    ->name('api.add-update-property-analytic');
