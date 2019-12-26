<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('clientid', 200)->nullable();
			$table->string('clientname', 200)->nullable();
			$table->string('projectname', 500)->nullable();
			$table->string('projectid', 100)->nullable();
			$table->date('startdate');
			$table->date('enddate');
			$table->string('cost', 200);
			$table->string('priority', 200);
			$table->string('status', 200)->nullable()->default('ASSIGNED');
			$table->string('orderform', 500)->nullable();
			$table->string('loano', 300)->nullable();
			$table->string('agreementno', 300)->nullable();
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
		Schema::drop('projects');
	}

}
