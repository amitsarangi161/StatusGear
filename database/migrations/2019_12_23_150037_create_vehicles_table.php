<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVehiclesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vehicles', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('vehicletype', 200)->nullable();
			$table->string('vehiclename', 200)->nullable();
			$table->string('vehicleno', 200)->nullable();
			$table->string('drivername', 200)->nullable();
			$table->string('vehicleimage', 1000)->nullable();
			$table->string('rcimage', 1000)->nullable();
			$table->string('drivermobile', 100)->nullable();
			$table->string('userid', 200)->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vehicles');
	}

}
