<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersCommunityMigration extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users_community', function (Blueprint $table) {
            $table->bigIncrements('id');
            //clave foránea de tabla comunidad
            $table->unsignedBigInteger('com_id');
            //clave foránea de tabla users
            $table->unsignedBigInteger('user_id');
            //claves foranea permissions
            $table->unsignedBigInteger('permissions_id');
//            $table->string('permissions_id')->unsigned();
            //created updated
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users_community');
    }

}
