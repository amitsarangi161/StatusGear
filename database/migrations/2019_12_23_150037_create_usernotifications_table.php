<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsernotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usernotifications', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nid', 200)->nullable();
			$table->string('user', 200)->nullable();
			$table->string('status', 200)->nullable()->default('PENDING');
			$table->text('remarks', 65535)->nullable();
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
		Schema::drop('usernotifications');
	}

}
