<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAdminMenuItems extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('admin_menu_items', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('parent_id');
            $table->string('name');
            $table->string('icon');
            $table->string('path_name');
            $table->text('roles');
            $table->boolean('enabled')->default(true);
            $table->text('ajax_load');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('menu_items');
    }
}
