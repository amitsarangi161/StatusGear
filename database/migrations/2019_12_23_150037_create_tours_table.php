<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateToursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tours', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('empid', 200)->nullable();
			$table->string('fromplace', 300)->nullable();
			$table->string('toplace', 200)->nullable();
			$table->date('fromdate')->nullable();
			$table->date('todate')->nullable();
			$table->text('description', 65535)->nullable();
			$table->string('status', 200)->nullable()->default('PENDING');
			$table->string('remarks', 200)->nullable();
			$table->string('approvedby', 200)->nullable();
			$table->string('cancelledby', 200)->nullable();
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
		Schema::drop('tours');
	}

}
