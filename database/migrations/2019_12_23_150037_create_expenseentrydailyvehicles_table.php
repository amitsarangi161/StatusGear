<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExpenseentrydailyvehiclesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('expenseentrydailyvehicles', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('expenseid', 200)->nullable();
			$table->string('dailyvehicleid', 200)->nullable();
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
		Schema::drop('expenseentrydailyvehicles');
	}

}
