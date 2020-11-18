<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void   
     */
    public function up()
    {
       DB::table('users')->insert(
       array('name' => 'Admin_gpgm' ,
       'email' => 'hh_bouzaouia@esi.dz' ,  
      'password' => bcrypt('123456789')
   )

       );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
