<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientGovernmentTable extends Migration {

	public function up()
	{
		Schema::create('client_government', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('client_id');
			$table->integer('governorate_id');
		});
	}

	public function down()
	{
		Schema::drop('client_government');
	}
}