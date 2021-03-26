<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

<<<<<<< HEAD
class ProHouseMigration extends Migration
{
=======
class ProHouseMigration extends Migration {

>>>>>>> 944970887f30e167f82de6fd62d3f23c874fc1d6
    /**
     * Run the migrations.
     *
     * @return void
     */
<<<<<<< HEAD
    public function up()
    {
        Schema::create('pro_house', function (Blueprint $table) {
            $table->id();
=======
    public function up() {
        Schema::create('pro_house', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('floor');
            $table->string('door');
            //metros cuadrados por superficie
            $table->integer('sqm');
            $table->integer('room');
            $table->integer('bathoom');
            $table->integer('occupants');
            //hacer un drobdown para selecionar(duplex,appartment,bussiness)
            $table->string('type');
>>>>>>> 944970887f30e167f82de6fd62d3f23c874fc1d6
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
<<<<<<< HEAD
    public function down()
    {
        Schema::dropIfExists('pro_house');
    }
=======
    public function down() {
        Schema::dropIfExists('pro_house');
    }

>>>>>>> 944970887f30e167f82de6fd62d3f23c874fc1d6
}
