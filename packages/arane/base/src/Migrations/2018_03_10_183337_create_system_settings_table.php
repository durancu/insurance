<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUserSettingsTable.
 */
class CreateSystemSettingsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service');
            $table->string('name');
            $table->string('label')->nullable();
            $table->string('description')->nullable();
            $table->string('type')->default('text');
            $table->text('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('system_settings');
    }
}
