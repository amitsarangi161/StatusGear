<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVendorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendors', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('vendorname', 200)->nullable();
			$table->string('mobile', 200)->nullable();
			$table->string('vendoridproof', 200)->nullable();
			$table->string('photo', 500)->nullable();
			$table->string('details', 500)->nullable();
			$table->string('bankname', 200)->nullable();
			$table->string('acno', 200)->nullable();
			$table->string('branchname', 200)->nullable();
			$table->string('ifsccode', 200)->nullable();
			$table->string('userid', 200)->nullable();
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
		Schema::drop('vendors');
	}

}
