<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCrsetupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crsetups', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('companyname', 300)->nullable();
			$table->string('contactno', 300)->nullable();
			$table->string('email', 300)->nullable();
			$table->string('gstno', 300)->nullable();
			$table->string('panno', 300)->nullable();
			$table->string('address', 300)->nullable();
			$table->string('acno', 300)->nullable();
			$table->string('bankname', 300)->nullable();
			$table->string('branchname', 300)->nullable();
			$table->string('ifsccode', 300)->nullable();
			$table->string('companylogo', 300)->nullable();
			$table->string('for', 200)->nullable();
			$table->string('draftdetails', 200)->nullable();
			$table->string('rtgsdetails', 200)->nullable();
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
		Schema::drop('crsetups');
	}

}
