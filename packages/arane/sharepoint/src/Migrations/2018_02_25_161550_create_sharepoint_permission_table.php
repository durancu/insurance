<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSharepointPermissionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('sharepoint_permission', function(Blueprint $table) {
            $table->unsignedInteger('sharepoint_id');
            $table->unsignedInteger('user_id');
            $table->string('permission', 1);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['sharepoint_id','user_id','permission']);
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sharepoint_permission');
	}

}
