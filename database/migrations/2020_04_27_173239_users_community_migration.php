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
            //claves primarias compuestas
            $table->integer('user_id')->unsigned();
            $table->integer('com_id')->unsigned();
            $table->string('permissions');
            //created updated
            $table->timestamps();
        });
        Schema::table('users_community', function (Blueprint $table) {
            //claves foránea dentro de la tabla usercomunity y las tablas que apuntan
            $table->foreign('com_id')->references('id')->on('communities');
            $table->foreign('user_id')->references('id')->on('users');
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
