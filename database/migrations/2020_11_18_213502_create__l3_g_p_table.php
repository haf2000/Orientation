<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateL3GPTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('L3GP', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->unique();
           $table->string('nom');
           $table->string('prenom');
           $table->char('section',1)->nullable();
           $table->string('resultat');
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
        Schema::dropIfExists('L3GP');
    }
}
