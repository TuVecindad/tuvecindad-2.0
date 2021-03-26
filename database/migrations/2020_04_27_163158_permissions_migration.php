<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PermissionsMigration extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('permissions', function (Blueprint $table) {
<<<<<<< HEAD
            $table->string('id');
=======

            $table->bigIncrements('id');
            $table->string('role'); //admin, owner, tenant
>>>>>>> 944970887f30e167f82de6fd62d3f23c874fc1d6
            $table->boolean('add_user');
            $table->boolean('del_user');

            //created y updated
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('permissions');
    }

}
