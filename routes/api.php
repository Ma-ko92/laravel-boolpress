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

// Route di esempio

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Richiamo il controller e ritorno un json
// Laravel in automatico mette api davanti all'url
Route::get('/posts', 'Api\PostController@index')->name('api.posts');

// Se il metodo è post basta cambiare il get in post
// Route::post('/posts', 'Api\PostController@index')->name('api.posts');
