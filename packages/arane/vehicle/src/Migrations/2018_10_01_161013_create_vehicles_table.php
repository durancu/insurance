<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration {
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->integer('year')->nullable();
            $table->string('vehicle_class')->nullable();
            $table->string('cylinders')->nullable();
            $table->string('drive')->nullable();
            $table->string('trany')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('fuel_type_1')->nullable();
            $table->string('fuel_type_2')->nullable();
            $table->string('barrels_08')->nullable();
            $table->string('barrels_a08')->nullable();
            $table->string('charge_120')->nullable();
            $table->string('charge_240')->nullable();
            $table->integer('city_08')->nullable();
            $table->string('city_08u')->nullable();
            $table->integer('city_a08')->nullable();
            $table->string('city_a08u')->nullable();
            $table->string('city_cd')->nullable();
            $table->string('city_e')->nullable();
            $table->string('city_uf')->nullable();
            $table->integer('co_2')->nullable();
            $table->integer('co_2a')->nullable();
            $table->string('co_2_tailpipe_ag_pm')->nullable();
            $table->string('co2_tailpipe_gpm')->nullable();
            $table->integer('comb_08')->nullable();
            $table->string('comb_08u')->nullable();
            $table->integer('comb_a08')->nullable();
            $table->string('comb_a08u')->nullable();
            $table->string('comb_e')->nullable();
            $table->string('combined_cd')->nullable();
            $table->string('combined_uf')->nullable();
            $table->string('displ')->nullable();
            $table->integer('engId')->nullable();
            $table->string('eng_dscr')->nullable();
            $table->integer('fe_score')->nullable();
            $table->integer('fuel_cost_08')->nullable();
            $table->integer('fuel_cost_a08')->nullable();
            $table->integer('ghg_score')->nullable();
            $table->integer('ghg_score_a')->nullable();
            $table->integer('highway_08')->nullable();
            $table->string('highway_08_u')->nullable();
            $table->integer('highway_a08')->nullable();
            $table->string('highway_a08u')->nullable();
            $table->string('highway_cd')->nullable();
            $table->string('highway_e')->nullable();
            $table->string('highway_uf')->nullable();
            $table->integer('hlv')->nullable();
            $table->integer('hpv')->nullable();
            $table->integer('lv2')->nullable();
            $table->integer('lv4')->nullable();
            $table->string('mpg_data')->nullable();
            $table->string('phev_blended')->nullable();
            $table->integer('pv2')->nullable();
            $table->integer('pv4')->nullable();
            $table->integer('range')->nullable();
            $table->string('range_city')->nullable();
            $table->string('range_city_a')->nullable();
            $table->string('range_hwy')->nullable();
            $table->string('range_hwy_a')->nullable();
            $table->string('u_city')->nullable();
            $table->string('u_city_a')->nullable();
            $table->string('u_highway')->nullable();
            $table->string('u_highway_a')->nullable();
            $table->integer('you_save_spend')->nullable();
            $table->string('guzzler')->nullable();
            $table->string('trans_dscr')->nullable();
            $table->string('t_charger')->nullable();
            $table->string('s_charger')->nullable();
            $table->string('atv_type')->nullable();
            $table->string('range_a')->nullable();
            $table->string('ev_motor')->nullable();
            $table->string('mfr_code')->nullable();
            $table->string('c_240_dscr')->nullable();
            $table->string('charge_240b')->nullable();
            $table->string('c_240b_dscr')->nullable();
            $table->string('start_stop')->nullable();
            $table->integer('phev_city')->nullable();
            $table->integer('phev_hwy')->nullable();
            $table->integer('phev_comb')->nullable();
            $table->timestamps();
        });
    }
    
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('vehicles');
    }
    
}
