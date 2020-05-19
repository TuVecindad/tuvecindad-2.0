<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property', function (Blueprint $table) {
             //claves foránea dentro de la tabla property y las tablas que apuntan
            $table->foreign('com_id')->references('id')->on('communities')->onDelete('cascade');
            $table->foreign('house_id')->references('id')->on('pro_house')->onDelete('cascade');
            $table->foreign('parking_id')->references('id')->on('pro_parking')->onDelete('cascade');
            $table->foreign('storage_id')->references('id')->on('pro_storage')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property', function (Blueprint $table) {
            //
        });
    }
}
