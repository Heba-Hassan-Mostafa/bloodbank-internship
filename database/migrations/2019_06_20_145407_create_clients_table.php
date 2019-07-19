<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 50);
			$table->string('email', 100)->unique();
			$table->date('birth_date');
			$table->integer('city_id')->unsigned();
			$table->string('phone');
			$table->date('donation_last_date');
			$table->string('password');
			$table->string('api_token', 60)->unique()->nullable();
			$table->integer('blood_type_id');
			$table->boolean('is_active')->default(1);
            $table->integer('pin_code')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}