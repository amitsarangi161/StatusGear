<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComplaintsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('complaints', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('type', 200)->nullable();
			$table->string('fromuserid', 200)->nullable();
			$table->string('touserid', 200)->nullable();
			$table->date('date');
			$table->string('description', 200)->nullable();
			$table->date('lastdate');
			$table->string('status', 200)->nullable()->default('PENDING');
			$table->string('remark', 200)->nullable();
			$table->string('resolveddate', 200)->nullable();
			$table->string('cc', 200)->nullable();
			$table->string('active', 200)->nullable()->default('1');
			$table->string('attachment', 1000);
			$table->date('differdateto')->nullable();
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
		Schema::drop('complaints');
	}

}
