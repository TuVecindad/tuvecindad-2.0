<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PropertyMigration extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('property', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cad_ref_pro');
            //claves foraneas
            $table->integer('com_id')->unsigned();
            $table->integer('owner')->unsigned();
            $table->integer('tenant')->unsigned();
            $table->integer('house_id')->unsigned();
            $table->integer('parking_id')->unsigned();
            $table->integer('storage_id')->unsigned();
             //claves foránea dentro de la tabla property y las tablas que apuntan
            $table->foreign('com_id')->references('id')->on('communities');
            $table->foreign('owner')->references('id')->on('users');
            $table->foreign('tenant')->references('id')->on('users');
            $table->foreign('house_id')->references('id')->on('pro_house');
            $table->foreign('parking_id')->references('id')->on('pro_parking');
            $table->foreign('storage_id')->references('id')->on('pro_storage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('property');
    }

}
