<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZipCodesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('zip_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('zip_code', 20);
            $table->string('state_code', 20);
            $table->string('state_name', 50);
            $table->string('city');
            $table->string('county');
            $table->float('latitude');
            $table->float('longitude');
            $table->bigInteger('area_land_miles');
            $table->bigInteger('area_water_miles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('zip_codes');
    }
}
