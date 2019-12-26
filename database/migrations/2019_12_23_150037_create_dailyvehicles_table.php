<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDailyvehiclesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dailyvehicles', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('vehicleid', 200)->nullable();
			$table->date('date')->nullable();
			$table->string('starttime', 300)->nullable();
			$table->string('endtime', 300)->nullable();
			$table->string('startmeterreading', 300)->nullable();
			$table->string('endmeterreading', 300)->nullable();
			$table->string('image', 300)->nullable();
			$table->string('description', 300)->nullable();
			$table->string('projectid', 200)->nullable();
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
		Schema::drop('dailyvehicles');
	}

}
