<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFichevoeuxrempliToGm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

     Schema::table('gm', function (Blueprint $table) {
            $table->char('fichevoeux_remp',1)->default('0');
        });

    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
