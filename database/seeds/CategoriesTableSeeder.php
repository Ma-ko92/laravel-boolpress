<?php

use Illuminate\Database\Seeder;
// Inserisco il model
use App\Category;
// Inserisco il model per lo slug
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Viaggi',
            'Cucina',
            'Tempo libero',
            'Foto',
            'Ostelli'

        ];

        // Con un ciclo foreach inserisco i valori
        foreach($categories as $category_name) {
            // Ad ogni gior creo una nuova categoria
            $new_category = new Category();
            // Popolo la nuova categoria
            $new_category->name = $category_name;
            // Creo lo slug
            $new_category->slug = Str::slug($new_category->name, '-');
            // Infine salvo
            $new_category->save();
        }
    }
}
