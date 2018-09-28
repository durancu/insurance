<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('states', function (Blueprint $table) {
            $table->string('id', 2);
            $table->string('name');
            $table->string('type');
            $table->string('sort');
            $table->string('fips_state');
            $table->string('assoc_press');
            $table->string('standard_federal_region');
            $table->string('census_region');
            $table->string('census_region_name');
            $table->string('census_division');
            $table->string('census_division_name');
            $table->string('circuit_court');
            $table->timestamps();

            $table->primary('id');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('states');
    }

}
