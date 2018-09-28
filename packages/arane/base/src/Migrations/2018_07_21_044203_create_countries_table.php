<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::dropIfExists('countries');
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('iso', 2);
            $table->string('name', 80);
            $table->string('nice_name', 80);
            $table->string('iso_3', 3)->nullable();
            $table->unsignedSmallInteger('num_code');
            $table->unsignedSmallInteger('phone_code');
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
        Schema::dropIfExists('countries');
    }
}
