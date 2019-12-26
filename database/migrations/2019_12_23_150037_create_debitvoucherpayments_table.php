<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDebitvoucherpaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('debitvoucherpayments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('did', 200)->nullable();
			$table->string('amount', 200)->nullable();
			$table->string('paymenttype', 300)->nullable();
			$table->string('remarks', 1000)->nullable();
			$table->string('bankid', 100)->nullable();
			$table->string('paymentstatus', 1000)->default('PENDING');
			$table->string('transactionid', 200)->nullable();
			$table->date('dateofpayment')->nullable();
			$table->string('paidby', 200)->nullable();
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
		Schema::drop('debitvoucherpayments');
	}

}
