<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('empid', 200)->nullable();
			$table->string('latitude', 200)->nullable();
			$table->string('longitude', 200)->nullable();
			$table->string('orginallocation', 200)->nullable();
			$table->date('date')->nullable();
			$table->time('time')->nullable();
			$table->string('travelid', 200);
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
		Schema::drop('locations');
	}

}
