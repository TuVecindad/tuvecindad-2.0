<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersCommunityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_community', function (Blueprint $table) {
            //claves foránea dentro de la tabla usercomunity y las tablas que apuntan
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('com_id')->references('id')->on('communities')->onDelete('cascade');
            $table->foreign('permissions_id')->references('id')->on('permissions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_community', function (Blueprint $table) {
            //
        });
    }
}
