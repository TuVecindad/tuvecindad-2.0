<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BulletinMigration extends Migration {
    public function up() {
    Schema::table('bulletin', function (Blueprint $table) {
        //claves foránea dentro de la tabla bulletin y las tablas que apuntan
        $table->foreign('com_id')->references('id')->on('communities');
        $table->foreign('user_id')->references('id')->on('users');
    }); 
}

