<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSharepointsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sharepoints', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('file_id')->default(0);
            $table->unsignedInteger('owner_id');
            $table->string('virtual_path')->default("/");
            $table->unsignedSmallInteger('public')->default(0);
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

        Schema::drop('sharepoints');
    }

}
