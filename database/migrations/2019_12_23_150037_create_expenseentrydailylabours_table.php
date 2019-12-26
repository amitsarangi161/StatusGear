<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExpenseentrydailylaboursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('expenseentrydailylabours', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('expenseid', 200)->nullable();
			$table->string('dailylabourid', 200)->nullable();
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
		Schema::drop('expenseentrydailylabours');
	}

}
