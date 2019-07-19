<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('client_id');
			$table->string('patient_name', 60);
			$table->integer('patient_age');
			$table->integer('blood_type_id');
			$table->integer('bags_number');
			$table->string('hospital_name');
            $table->string('hospital_address');
			$table->decimal('latitude', 10,8)->nullable();
			$table->decimal('longitude', 10,8)->nullable();
			$table->integer('city_id');
			$table->integer('phone');
			$table->text('notes');
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}