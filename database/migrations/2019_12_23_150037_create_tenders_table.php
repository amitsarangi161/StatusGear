<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTendersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tenders', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('nameofthework', 65535)->nullable();
			$table->text('clientname', 65535)->nullable();
			$table->string('workvalue', 100)->nullable();
			$table->date('nitpublicationdate')->nullable();
			$table->string('source', 200)->nullable();
			$table->string('corrigendumfile', 500)->nullable();
			$table->string('tenderpriority', 200)->nullable();
			$table->string('typeofwork', 100)->nullable();
			$table->date('lastdateofsubmisssion')->nullable();
			$table->date('rfpavailabledate')->nullable();
			$table->string('rfpdocument', 200)->nullable();
			$table->string('emdamount', 200)->nullable();
			$table->string('amountinword', 300)->nullable();
			$table->string('emdinformof', 100)->nullable();
			$table->string('tenderamount', 300)->nullable();
			$table->string('tenderrefno', 300)->nullable();
			$table->string('noofcovers', 300)->nullable();
			$table->string('tendervalidityindays', 200)->nullable();
			$table->date('tendervaliditydate')->nullable();
			$table->string('salestartdate', 300)->nullable();
			$table->string('saleenddate', 300)->nullable();
			$table->string('bidstartdate', 500)->nullable();
			$table->string('bidenddate', 500)->nullable();
			$table->string('prebidmeetingdate', 500)->nullable();
			$table->string('emdpayableto', 500)->nullable();
			$table->string('tenderfeepayableto', 500)->nullable();
			$table->string('tenderamountinword', 500)->nullable();
			$table->string('refpageofrfp', 100)->nullable();
			$table->string('tendercostinformof', 300)->nullable();
			$table->string('sitevisitrequired', 100)->nullable();
			$table->text('sitevisitdescription', 65535)->nullable();
			$table->string('workablesite', 100)->nullable();
			$table->text('safetyconcern', 65535)->nullable();
			$table->string('thirdpartyapproval', 100)->nullable();
			$table->string('inhousecapacity', 100)->nullable();
			$table->string('thirdpartyinvolvement', 100)->nullable();
			$table->string('areaaffectedbyextremist', 100)->nullable();
			$table->string('keypositionbemanaged', 100)->nullable();
			$table->string('projectdurationsufficient', 100)->nullable();
			$table->string('localofficesetup', 100)->nullable();
			$table->string('recomended', 100)->nullable();
			$table->string('paymentscheduleclear', 100)->nullable();
			$table->string('paymentscheduleambiguty', 100)->nullable();
			$table->string('penalityclause', 100)->nullable();
			$table->string('penalityclauseambiguty', 100)->nullable();
			$table->string('wehaveexpertise', 100)->nullable();
			$table->text('wehaveexpertisedescription', 65535)->nullable();
			$table->string('contractualambiguty', 100)->nullable();
			$table->text('contractualambigutydescription', 65535)->nullable();
			$table->string('extensivefieldinvestigation', 100)->nullable();
			$table->text('extensivefieldinvestigationdescription', 65535)->nullable();
			$table->string('requiredexperienceoffirm', 100)->nullable();
			$table->text('requiredexperienceoffirmdescription', 65535)->nullable();
			$table->text('anyotherrequirement', 65535)->nullable();
			$table->string('ratetobequoted', 100)->nullable();
			$table->string('status', 300)->nullable()->default('PENDING');
			$table->text('notelligiblereason', 65535)->nullable();
			$table->string('paymentsystem', 200)->nullable();
			$table->text('thirdpartyapprovaldetails', 65535)->nullable();
			$table->text('paymentsystemdetails', 65535)->nullable();
			$table->string('registrationamount', 1000)->nullable();
			$table->string('registrationamountinword', 1000)->nullable();
			$table->string('registrationamountinformof', 1000)->nullable();
			$table->string('registrationamountpayableto', 1000)->nullable();
			$table->text('notes', 65535)->nullable();
			$table->text('rejectnotes', 65535)->nullable();
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
		Schema::drop('tenders');
	}

}
