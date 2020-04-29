<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CommonAreaMigration extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('common_area', function (Blueprint $table) {

            //clave primaria por defecto en esta tabla el incremental esta a false 
            //ya que esta relacionada con la tabla communities
            $table->integer('com_id')->unsigned();
            //zonas comunes
            $table->boolean('pool');
            $table->boolean('gym');
            $table->boolean('hall');
            $table->boolean('rooftop');
            $table->boolean('garden');
            //updated y created
            $table->timestamps();
        });
        
         Schema::table('common_area', function (Blueprint $table) {
            //claves foránea dentro de la tabla bulletin y las tablas que apuntan
            $table->foreign('com_id')->references('id')->on('communities');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('common_area');
    }

}
