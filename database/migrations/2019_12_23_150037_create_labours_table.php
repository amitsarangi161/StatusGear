<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLaboursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('labours', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('labourname', 1000)->nullable();
			$table->text('address', 65535)->nullable();
			$table->string('mobile', 200)->nullable();
			$table->string('userid', 100)->nullable();
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
		Schema::drop('labours');
	}

}
