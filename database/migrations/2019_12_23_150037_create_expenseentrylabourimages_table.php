<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExpenseentrylabourimagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('expenseentrylabourimages', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('expid', 200)->nullable();
			$table->string('image', 1000)->nullable();
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
		Schema::drop('expenseentrylabourimages');
	}

}
