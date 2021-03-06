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

// Not remove (Metodo della classe Auth che importa le rotte che necessitano di autenticazione)
// Potrebbe non servire includerlo
Auth::routes();

// Home controller di esempio, aggiunto dalla funzione di sopra,
Route::get('/', 'HomeController@index')->name('home');
// Creo una route per i contatti
Route::get('/contacts', 'HomeController@contacts')->name('contacts');
// Creo una route per le mail di contatto(dato che questi dati verranno gestiti ma non mostrati nel' url, posso usare post)
Route::post('/handle-new-contact', 'HomeController@handleNewContact')->name('handle-new-contact');
// Creo una route per una pagina di ringraziamento
Route::get('/contacts-thank-you', 'HomeController@contactsThankYou')->name('contacts-thank-you');


// Gestione gruppi di route pubbliche
Route::get('/blog', 'PostController@index')->name('blog');
Route::get('/blog/{slug}', 'PostController@show')->name('blog-page');

Route::get('/categories', 'CategoryController@index')->name('categories');
Route::get('/categories/{slug}', 'CategoryController@show')->name('category-page');

Route::get('/tags/{slug}', 'TagController@show')->name('tag-page');

// Route che mostra i post visualizzati con Vuejs
Route::get('/vue-posts', 'PostController@vuePosts')->name('vue-post');



// Gestione  gruppi di route protette, tramite prefisso
Route::prefix('admin') 
        ->namespace('Admin') 
        // Dare un nome ai gruppi (il punto serve a separare)
        ->name('admin.')
        ->middleware('auth') 
        ->group(function () {   
            // qua inserirĂ² tutte le route che faranno parte degli utenti loggati
            Route::get('/', 'HomeController@index')->name('home'); 
            // Questo resource crea tutte le route necessarie per le operazioni crud.  
            Route::resource('posts', 'PostController');//->name('post');
      });




