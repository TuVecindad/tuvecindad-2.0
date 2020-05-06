<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

<<<<<<< HEAD
class ProStorageMigration extends Migration
{
=======
class ProStorageMigration extends Migration {

>>>>>>> 944970887f30e167f82de6fd62d3f23c874fc1d6
    /**
     * Run the migrations.
     *
     * @return void
     */
<<<<<<< HEAD
    public function up()
    {
        Schema::create('pro_storage', function (Blueprint $table) {
            $table->id();
=======
    public function up() {
        Schema::create('pro_storage', function (Blueprint $table) {
            $table->bigIncrements('id');
            //metros cuadrados por superficie
            $table->integer('sqm');
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
        Schema::dropIfExists('pro_storage');
    }
=======
    public function down() {
        Schema::dropIfExists('pro_storage');
    }

>>>>>>> 944970887f30e167f82de6fd62d3f23c874fc1d6
}
