<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserrequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('userrequests', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 200);
			$table->string('username', 200)->nullable();
			$table->string('email', 200);
			$table->string('password', 200);
			$table->string('mobile', 200);
			$table->string('pass', 200);
			$table->string('usertype', 200)->nullable()->default('USER');
			$table->string('status', 200)->default('1');
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
		Schema::drop('userrequests');
	}

}
