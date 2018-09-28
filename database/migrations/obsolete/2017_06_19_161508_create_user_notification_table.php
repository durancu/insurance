<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserNotificationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_notification', function(Blueprint $table)
		{
			$table->integer('notification_id')->index('user_notification_notification_id_foreign');
            $table->integer('user_id')->index('user_notification_user_id_foreign');
			$table->index(['notification_id','user_id']);
			$table->primary(['notification_id','user_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_notification');
	}

}
