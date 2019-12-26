<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvoicenosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoicenos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('billid', 200)->nullable();
			$table->string('crvoucherid', 200)->nullable();
			$table->string('company', 200)->nullable();
			$table->string('invyear', 200)->nullable();
			$table->integer('invno')->nullable();
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
		Schema::drop('invoicenos');
	}

}
