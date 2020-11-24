<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFicheVoeuxGMTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FicheVoeuxGM', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->unique();
           $table->string('nom');
           $table->string('prenom');
           $table->integer('anet');
           $table->string('origine')->nullable();
           $table->char('section',1);
           $table->string('choix1')->nullable();
           $table->string('choix2')->nullable();
           $table->string('choix3')->nullable();
           $table->string('nationalite')->nullable();

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
        Schema::dropIfExists('FicheVoeuxGM');
    }
}
