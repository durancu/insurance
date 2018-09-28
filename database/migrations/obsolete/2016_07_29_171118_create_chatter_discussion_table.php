<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChatterDiscussionTable extends Migration
{
    public function up()
    {
        Schema::create('chatter_discussion', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('chatter_category_id')->default('1');
            $table->string('title');
            $table->unsignedInteger('user_id');
            $table->boolean('sticky')->default(false);
            $table->unsignedInteger('views')->default('0');
            $table->boolean('answered')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chatter_discussion');
    }
}
