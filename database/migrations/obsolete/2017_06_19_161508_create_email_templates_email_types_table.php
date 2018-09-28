<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmailTemplatesEmailTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('email_templates_email_types', function(Blueprint $table)
		{
			$table->integer('template_id')->index('FKemail_temp388789');
			$table->integer('type_id')->index('FKemail_temp59357');
			$table->primary(['template_id','type_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('email_templates_email_types');
	}

}
