<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Importo ls classe per le immagini
use Illuminate\Support\Facades\Storage;
// importo il model
use App\Post;
// Importo il model
use App\Category;
// Importo il model
use App\Tag;
// importo la funzione per creare lo slug
use Illuminate\Support\Str;
// Per l'invio email includo la classe
use Illuminate\Support\Facades\Mail;
// includo la classe dell'email che voglio inviare
use App\Mail\NewPostAdminNotification;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Se necessito prendere un determinato elemento, nelle () ci va l'id
        // $post = Post::findOrFail();
        $posts = Post::all();

        // Detach rimuove un tag ad un elemento
        // Nelle () va inserito l'id, se più di uno usare un array[id, id]
        // $post->tags()->detach();
        // Attach aggiunge un tag ad un elemento
        // $post->tags()->attach();
        // Sync sovrascive tottalmente i tag
        // Esso ha bisogno delle quadre anche per singoli tag
        // Con sync array vuoto non assegno nessun tag
        // $post-tags()->sync();
        // Di solito queste funzioni vengono usate nei seed,
        // NB. con queste funzioni i cambiamenti sono immediati

        $data = [
            'posts' => $posts
        ];

        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Creal il form
    public function create()
    {
        // Richiamo tutte le categorie
        $categories = Category::all();
        // Richiamo i Tags
        $tags = Tag::all();

        $data = [
            'categories' => $categories,
            'tags' => $tags
        ];
        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Verifico che ci siano dati inseriti
        $request->validate([
            'title'=>'required|max:255',
            'content'=>'required|max:65000',
            // Per evitare problemi di sicurezza(se nullo inserire prima nullable)
            'category_id' => 'nullable|exists:categories,id',
            // stessa cosa per tags
            'tags' => 'nullable|exists:tags,id',
            // Per convalidare le immagini
            // Per un totale di grandezza |max:numero in kb
            'cover-image' => 'nullable|image'
        ]);

        $new_post_data = $request->all();

        // Condizione che verifica la categoria
        // se vuota restuituisce null
        // if(empty($new_post_data['category_id'])) {
        //     $new_post_data['category_id'] = null;
        // }
        
        // Inserisco lo slug
        $new_slug = Str::slug($new_post_data['title'], '-');
        // salvo lo slug base
        $base_slug = $new_slug;

        // Verifico che lo slug non sia già presente
        $existing_post_with_slug = Post::where('slug', '=', $new_slug)->first();
        // Imposto il counter a 2
        $counter = 2;

        // Se presente, lo cambio prendendo quello base e ci aggiungo un numero
        // es: se titolo-1 allora titolo-2
        while ($existing_post_with_slug) {
            $new_slug = $base_slug . '-' . $counter;
            $counter++;
            // Se non presente ritorna null, altrimenti riparte il ciclo
            $existing_post_with_slug = Post::where('slug', '=', $new_slug)->first();
        }

        // Se lo slug non è già presente, salviamo il nuovo slug
        $new_post_data['slug'] = $new_slug;

        // Se presente un immagine la salvo in storage e aggiungo il path relativo
        // in $new_post_data
        // Verifico che l'immagine sia settata
        if(isset($new_post_data['cover-image'])) {
            // Il metodo put in questo caso ha bisogno di 2 argomenti, la sottocartella del file e il file
            $new_img_path = Storage::put('posts-cover', $new_post_data['cover-image']);

            // Put torna una stringa relativa al path dell'immagine, e torna false se il caricamento fallisce 

            // condizione che verifichi il successo del caricamneto del file
            if($new_img_path) {
                // Salvo nel database
                $new_post_data['cover'] = $new_img_path;
            }
        }


        $new_post = new Post();
        $new_post->fill($new_post_data);
        $new_post->save();

        // Sync va dopo in quanto crea subito la relazione nella tabella ponte
        // Creo una conzione che verifi se il tag sia presente
        // Verifico per sicurezza che sia anche un array
        // In questo caso si può usare tranquillamente attach in quanto non si ha dei tags precedenti da rimuovere
        if(isset($new_post_data['tags']) && is_array($new_post_data['tags'])) {
            $new_post->tags()->sync($new_post_data['tags']);
        }

        // Invio email all'amministratore del sito(e passo l'istanza dell'oggetto completa appena creato)
        Mail::to('boolpress@email.it')->send(/* istanza della mail da mandare */ new NewPostAdminNotification($new_post));


        return redirect()->route('admin.posts.show', ['post' => $new_post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Mostro i singoli post
    public function show($id)
    {
        $post = Post::findOrFail($id);

        $data = [
            'post' => $post,
            // Per evitare di fare più chiamate
            'post_category' => $post->category,
            // Passo i tags
            'post_tags' => $post->tags
        ];

        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags
        ];

        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required|max:255',
            'content'=>'required|max:65000',
            // Per evitare problemi di sicurezza(se nullo inserire prima nullable) esso viene 
            // salvato automaticamente perchè è presente nei fillable.
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
            // Per convalidare le immagini
            // Per un totale di grandezza |max:numero in kb
            'cover-image' => 'nullable|image'
        ]);

        $update_post_data = $request->all();

        // Cerco se il post esiste
        $post = Post::findOrFail($id);
        // Slug di default
        $update_post_data['slug'] = $post->slug;
        
        // Condizione che verifica se il titolo del nuovo post è diverso da quello precedente, altrimenti lo slung non varia
        if($update_post_data['title'] != $post->title) {
            //slug
            $new_slug = Str::slug($update_post_data['title'], '-');
            // salvo lo slug base
            $base_slug = $new_slug;

            // Verifico che lo slug non sia già presente
            $existing_post_with_slug = Post::where('slug', '=', $new_slug)->first();
            // Imposto il counter a 2
            $counter = 2;

            // Se presente, lo cambio prendendo quello base e ci aggiungo un numero
            // es: se titolo-1 allora titolo-2
            while ($existing_post_with_slug) {
                $new_slug = $base_slug . '-' . $counter;
                $counter++;
                // Se non presente ritorna null, altrimenti riparte il ciclo
                $existing_post_with_slug = Post::where('slug', '=', $new_slug)->first();
            }

            // Se lo slug non è già presente, salviamo il nuovo slug
            $update_post_data['slug'] = $new_slug;
            }

            // Per update immagini(simile a create)
            if(isset($modified_post_data['cover-image'])) {
                $image_path = Storage::put('posts-cover', $modified_post_data['cover-image']);

                if($image_path) {
                    $modified_post_data['cover'] = $image_path;
                }
            }
            
            $post->update($update_post_data);

            // Tags
            if(isset($update_post_data['tags']) && is_array($update_post_data['tags'])) {
                $post->tags()->sync($update_post_data['tags']);
            } else {
                // In questo modo se non cè nessuna checkbox segnata salva un array vuoto
                $post->tags()->sync([]);
            }
            

            return redirect()->route('admin.posts.show', ['post' => $post->id]);
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        // Svuoto i tags prima di eliminare un elemento per evitare tabelle orfane in quanto legate da una relazione
        $post->tags()->sync([]);

        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
