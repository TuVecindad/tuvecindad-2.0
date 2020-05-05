<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BulletinMigration extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('bulletin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('body');
            //clave foráneas de tabla comunidad

            $table->unsignedBigInteger('com_id');
            //clave foránea de tabla users

            $table->unsignedBigInteger('user_id');
            //genera automáticamente los campos (created_at, updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('bulletin');
    }

}
