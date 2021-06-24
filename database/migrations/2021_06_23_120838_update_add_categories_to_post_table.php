<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAddCategoriesToPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('slug'); // se facoltativa aggiungere ->nullable();

            // Creo la foreign key
            $table->foreign('category_id')
                // Collegata a id
                ->references('id')
                // Tabella categories
                ->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //per cancellare la colonna, prima cancello la relazione(nome tabella_nome colonna_foreign) per evitare problemi nel rollback
            $table->dropForeign('posts_category_id_foreign');
            // Poi la colonna
            $table->dropColumn('category_id');
        });
    }
}
