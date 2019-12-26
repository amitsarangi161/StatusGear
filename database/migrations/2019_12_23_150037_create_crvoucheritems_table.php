<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCrvoucheritemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crvoucheritems', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('headerid', 200)->nullable();
			$table->string('slno', 200)->nullable();
			$table->text('workdetails', 65535)->nullable();
			$table->string('hsn', 200)->nullable();
			$table->string('unit', 200)->nullable();
			$table->float('rate', 10, 0)->nullable();
			$table->string('quantity', 200)->nullable();
			$table->float('amount', 10, 0)->nullable();
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
		Schema::drop('crvoucheritems');
	}

}
