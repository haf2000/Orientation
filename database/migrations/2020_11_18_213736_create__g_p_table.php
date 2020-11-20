<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGPTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('GP', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->unique();
           $table->string('nom_prenom');
           $table->char('section',1)->nullable();
           $table->string('choix1')->nullable();
           $table->string('choix2')->nullable();
            $table->string('moy_s1')->nullable();
           $table->string('moy_s2')->nullable();
           $table->string('moy_an')->nullable();
           $table->integer('session');
           $table->integer('r')->default('0');
           $table->float('mc')->default('0.0');
           $table->string('orientation')->nullable();
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
        Schema::dropIfExists('GP');
    }
}
