<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDailynotificationlogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dailynotificationlogs', function(Blueprint $table)
		{
			$table->integer('id');
			$table->string('nid', 200)->nullable();
			$table->string('user', 200)->nullable();
			$table->date('date')->nullable();
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
		Schema::drop('dailynotificationlogs');
	}

}
