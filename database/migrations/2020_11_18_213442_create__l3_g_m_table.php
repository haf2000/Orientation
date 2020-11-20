<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateL3GMTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('L3GM', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->unique();
           $table->string('nom_prenom');
           $table->char('section',1)->nullable();
           $table->string('resultat');
           $table->string('specialite')->nullable();
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
        Schema::dropIfExists('L3GM');
    }
}
