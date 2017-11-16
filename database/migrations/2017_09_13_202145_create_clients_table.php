<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('documento')->unique();
            $table->string('email');
            $table->string('telefone');
            $table->boolean('inadimplente')->default(0);
            $table->date('date_nasc')->nullable();
            $table->enum('sexo', array_keys(App\Client::SEXO))->nullable();
            $table->string('pessoa');
            $table->enum('estado_civil', array_keys(\App\Client::ESTADOS_CIVIS))->nullable();
            $table->enum('deficiencia_fisica', array_keys(\App\Client::DEFICIENCIAS))->nullable();
            $table->string('fantasia')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
