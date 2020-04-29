<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProHouseMigration extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('pro_house', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('floor');
            $table->string('door');
            //metros cuadrados por superficie
            $table->integer('sqm');
            $table->integer('room');
            $table->integer('bathoom');
            $table->integer('occupants');
            //hacer un drobdown para selecionar(duplex,appartment,bussiness)
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('pro_house');
    }

}
