<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BulletinMigration extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('bulletin', function (Blueprint $table) {
            $table->increments('id');
            $table->text('body');
            //clave foráneas de tabla comunidad
            $table->integer('com_id')->unsigned();
            //clave foránea de tabla users
            $table->integer('user_id')->unsigned();
            //claves foránea dentro de la tabla bulletin y las tablas que apuntan
            $table->foreign('com_id')->references('id')->on('communities');
            $table->foreign('user_id')->references('id')->on('users');   
            //genera automáticamente los campos (created_at, updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('bulletin');
    }

}
