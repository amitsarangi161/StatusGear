<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chats', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('sender', 200);
			$table->string('reciver', 200);
			$table->text('message', 65535)->nullable();
			$table->string('attachment', 500)->nullable();
			$table->string('convertationid', 200)->nullable();
			$table->string('attachmentrealname', 200)->nullable();
			$table->string('seen', 200)->nullable()->default('1');
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
		Schema::drop('chats');
	}

}
