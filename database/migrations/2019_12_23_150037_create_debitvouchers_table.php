<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDebitvouchersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('debitvouchers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('headerid', 200)->nullable();
			$table->string('itemname', 500)->nullable();
			$table->string('unit', 100)->nullable();
			$table->string('qty', 200)->nullable();
			$table->string('mrp', 200)->nullable();
			$table->string('discount', 200)->nullable();
			$table->string('price', 200)->nullable();
			$table->string('sgstrate', 200)->nullable();
			$table->string('sgstcost', 200)->nullable();
			$table->string('cgstrate', 200)->nullable();
			$table->string('cgstcost', 200)->nullable();
			$table->string('igstrate', 200)->nullable();
			$table->string('igstcost', 200)->nullable();
			$table->string('grossamt', 200)->nullable();
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
		Schema::drop('debitvouchers');
	}

}
