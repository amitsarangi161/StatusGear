<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTravelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('travels', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('empid', 300)->nullable();
			$table->string('fromplace', 300)->nullable();
			$table->string('toplace', 300)->nullable();
			$table->text('description', 65535)->nullable();
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
		Schema::drop('travels');
	}

}
