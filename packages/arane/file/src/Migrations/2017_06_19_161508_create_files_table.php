<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFilesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up() {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stored_id');
            $table->string('name');
            $table->string('path');
            $table->string('type');
            $table->string('disk')->default("s3");
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('files');
    }

}
