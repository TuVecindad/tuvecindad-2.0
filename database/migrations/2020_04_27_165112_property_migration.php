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
            $table->bigIncrements('id');
            $table->string('cad_ref_pro');
            //claves foraneas
            $table->unsignedBigInteger('com_id');
            $table->integer('owner');
            $table->integer('tenant');
            $table->unsignedBigInteger('house_id');
            $table->unsignedBigInteger('parking_id');
            $table->unsignedBigInteger('storage_id');
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
