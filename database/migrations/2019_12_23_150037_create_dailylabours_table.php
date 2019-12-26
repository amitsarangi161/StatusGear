<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDailylaboursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dailylabours', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->date('date')->nullable();
			$table->string('workingimage', 300)->nullable();
			$table->string('description', 300)->nullable();
			$table->string('userid', 200)->nullable();
			$table->string('projectid', 200)->nullable();
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
		Schema::drop('dailylabours');
	}

}
