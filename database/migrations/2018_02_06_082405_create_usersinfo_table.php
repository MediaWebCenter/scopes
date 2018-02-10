<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateUsersinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('api_token');
            $table->integer('scope');
            $table->integer('xrequest');
            $table->dateTime('expired_on');
            $table->timestamps();
            
             //foreign key para asignar el id relacionarlo con el user_id, con borrado en cascada
             $table->foreign('user_id')
             //referido al id de la table users
                     ->references('id')
                     ->on('users')
           
             //se borra en cascada, se eliminan ambos registros
                     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_infos');
    }
}
