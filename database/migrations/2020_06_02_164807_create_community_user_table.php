<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunityUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('community_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            //clave foránea de tabla comunidad
            $table->unsignedBigInteger('community_id');
            //clave foránea de tabla users
            $table->unsignedBigInteger('user_id');
            //claves foranea permissions
            $table->unsignedBigInteger('role_id')->default(2);
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
        Schema::dropIfExists('community_user');
    }
}
