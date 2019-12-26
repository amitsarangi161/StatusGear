<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBillheadersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('billheaders', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('projectid', 200)->nullable();
			$table->string('fullinvno', 200)->nullable();
			$table->string('userid', 200)->nullable();
			$table->string('clientname', 500)->nullable();
			$table->string('email', 200)->nullable();
			$table->string('gstno', 200)->nullable();
			$table->string('panno', 300)->nullable();
			$table->string('contactno', 100)->nullable();
			$table->string('fax', 200)->nullable();
			$table->text('nameofthework', 65535)->nullable();
			$table->string('address', 300)->nullable();
			$table->string('invoicedate', 300)->nullable();
			$table->string('status', 300)->nullable();
			$table->string('remarks', 300)->nullable();
			$table->float('cgstrate', 10, 0)->nullable();
			$table->float('cgstvalue', 10, 0)->nullable();
			$table->float('sgstrate', 10, 0)->nullable();
			$table->float('sgstvalue', 10, 0)->nullable();
			$table->float('igstrate', 10, 0)->nullable();
			$table->float('igstvalue', 10, 0)->nullable();
			$table->string('discounttype', 200)->nullable();
			$table->string('discount', 200)->nullable();
			$table->string('discountvalue', 200)->nullable();
			$table->float('total', 10, 0)->nullable();
			$table->float('totalpayable', 10, 0)->nullable();
			$table->float('advancepayment', 10, 0)->nullable();
			$table->float('netpayable', 10, 0)->nullable();
			$table->string('invyear', 200)->nullable();
			$table->string('invno', 200)->nullable();
			$table->string('company', 200)->nullable();
			$table->string('claimedrate', 200)->nullable();
			$table->string('claimedvalue', 200)->nullable();
			$table->string('refno', 200)->nullable();
			$table->date('refdate')->nullable();
			$table->string('bankid', 200)->nullable();
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
		Schema::drop('billheaders');
	}

}
