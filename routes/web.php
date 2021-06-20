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

// Not remove
Auth::routes();

// aggiungendo ->middleware('auth') rendo la route accessibile solo a chi è loggato
Route::get('/', 'HomeController@index')->name('home');

// Gestione gruppi di route pubbliche
Route::get('/blog', 'PostController@index')->name('blog');
Route::get('/blog/{slug}', 'PostController@show')->name('blog-page');

// Gestione  gruppi di route protette
Route::prefix('admin') 
        ->namespace('Admin') 
        // Dare un nome ai gruppi (il punto è per separare)
        ->name('admin.')
        ->middleware('auth') 
        ->group(function () {   
            // qua inserirò tutte le route che voglio
            Route::get('/', 'HomeController@index')->name('home'); 

            Route::resource('posts', 'PostController');
      });




