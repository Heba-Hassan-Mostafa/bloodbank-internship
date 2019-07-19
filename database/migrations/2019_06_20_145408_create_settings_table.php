<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('app_url');
			$table->integer('phone');
			$table->string('email', 100);
			$table->string('facebook_url');
			$table->string('youtube_url');
			$table->string('twitter_url');
			$table->string('whatsup');
			$table->string('instgram_url');
			$table->text('about_app');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}