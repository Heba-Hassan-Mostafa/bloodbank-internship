<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTokensTable extends Migration {

	public function up()
	{
		Schema::create('tokens', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
			$table->string('token');
			$table->enum('type', array('android', 'ios'));
		});
	}

	public function down()
	{
		Schema::drop('tokens');
	}
}