<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateNotificationSubscriptionsTable.
 */
class CreateNotificationSubscriptionsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('notification_subscriptions', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('channel_id');
            $table->unsignedSmallInteger('email_subscribed')->default(0);
            $table->unsignedSmallInteger('sms_subscribed')->default(0);
            $table->unsignedSmallInteger('toast_subscribed')->default(0);
            $table->timestamps();

            $table->primary(['user_id', 'channel_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('notification_subscriptions');
    }
}
