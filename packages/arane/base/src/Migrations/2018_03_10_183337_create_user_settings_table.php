<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUserSettingsTable.
 */
class CreateUserSettingsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('locale')->default('en');
            $table->string('currency')->default('USD');
            $table->string('timezone')->default('UTC');
            $table->string('date_format')->default('d-m-Y');
            $table->string('time_format')->default('H:m:s');
            $table->string('number_format')->default('{"decimals": "2", "decimal_point":".", "thousand_separator":""}');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('user_settings');
    }
}
