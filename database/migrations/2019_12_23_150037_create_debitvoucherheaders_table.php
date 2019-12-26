<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDebitvoucherheadersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('debitvoucherheaders', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('vendorid', 200)->nullable();
			$table->string('billdate', 200)->nullable();
			$table->string('billno', 200)->nullable();
			$table->string('tmrp', 200)->nullable();
			$table->string('tdiscount', 200)->nullable();
			$table->string('tprice', 200)->nullable();
			$table->string('tqty', 200)->nullable();
			$table->string('tsgst', 200)->nullable();
			$table->string('tcgst', 200)->nullable();
			$table->string('tigst', 200)->nullable();
			$table->string('totalamt', 200)->nullable();
			$table->string('itdeduction', 200)->nullable()->default('0');
			$table->string('otherdeduction', 200)->nullable()->default('0');
			$table->string('finalamount', 200)->nullable();
			$table->string('approvalamount', 200)->nullable();
			$table->string('invoicecopy', 200)->nullable();
			$table->string('status', 200)->default('PENDING');
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
		Schema::drop('debitvoucherheaders');
	}

}
