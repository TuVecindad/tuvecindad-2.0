<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            //clave foránea de tabla comunidad
            $table->unsignedBigInteger('property_id');
            //clave foránea de tabla users
            $table->unsignedBigInteger('user_id');
            //claves foranea roles
            $table->unsignedBigInteger('role_id');
            //created - updated
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
        Schema::dropIfExists('property_user');
    }
}
