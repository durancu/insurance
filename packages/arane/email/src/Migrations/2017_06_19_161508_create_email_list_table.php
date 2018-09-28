<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmailListTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('email_lists', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique('name');
			$table->string('description', 255)->nullable();
			$table->string('emails', 255);
			$table->string('slug')->unique('slug');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('email_lists');
	}

}
