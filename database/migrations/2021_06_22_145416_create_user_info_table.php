<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Informazioni aggiuntive dell'utente
        Schema::create('user_info', function (Blueprint $table) {
            $table->id();
            $table->string('address', 255);
            $table->string('telephone', 20);
            $table->date('birthday');
            // Prima creo la colonna della foreign key
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            // Poi dichiaro la foreign key
            $table->foreign('user_id')
                // Farà riferimento all'id
                ->references('id')
                // Nella tabella users
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_info');
    }
}
