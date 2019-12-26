<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComplaintlogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('complaintlogs', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('complaintid', 200)->nullable();
			$table->string('writerid', 200)->nullable();
			$table->text('message', 65535)->nullable();
			$table->date('differdate')->nullable();
			$table->string('seen', 200)->nullable();
			$table->string('attachment', 1000)->nullable();
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
		Schema::drop('complaintlogs');
	}

}
