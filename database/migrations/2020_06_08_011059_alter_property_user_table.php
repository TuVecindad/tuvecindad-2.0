<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPropertyUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_user', function (Blueprint $table) {
         //claves foránea dentro de la tabla usercomunity y las tablas que apuntan
         $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
         $table->foreign('community_id')->references('id')->on('communities')->onDelete('cascade');
         $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
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
