@extends('layouts.app')
@section('content')
@inject('provider', 'App\Http\Controllers\AccountController')
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">PROJECT WISE PAYMENT REPORT</td>
		
	</tr>
	
</table>

<div class="table-responsive">
	<table class="table table-responsive table-hover table-bordered table-striped datatable1">
		<thead>
		<tr class="bg-navy">
			<td>PROJECT ID</td>
			<td>PROJECT NAME</td>
			<td>CLIENT NAME</td>
            <td>WORK ORDER VALUE</td>
			<td>EXPENSE AMOUNT</td>
			<td>BALANCE</td>
		</tr>
	</thead>
	<tbody>
     @php
       $sumamount=array();
     @endphp
		@foreach($projectwisepaymentreports as $projectwisepaymentreport)
           <tr>
           	<td>{{$projectwisepaymentreport['projectid']}}</td>
           	<td>{{$projectwisepaymentreport['projectname']}}</td>
           	<td>{{$projectwisepaymentreport['clientname']}}</td>

           	<td style="text-align: right;">{{$provider::moneyFormatIndia($sumamount[]=$projectwisepaymentreport['workordervalue'])}}</td>
           	<td style="text-align: right;">{{$provider::moneyFormatIndia($sumamount1[]=$projectwisepaymentreport['amount'])}}</td>
           	<td style="text-align: right;">{{$provider::moneyFormatIndia($projectwisepaymentreport['workordervalue']-$projectwisepaymentreport['amount'])}}</td>
           	
           </tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr class="bg-gray">
			
			<td colspan="3">TOTAL EXPENSE AMOUNTS</td>
			<td style="text-align: right;"><strong>Rs. {{$provider::moneyFormatIndia(array_sum($sumamount))}}</strong></td>
			<td style="text-align: right;"><strong>Rs. {{$provider::moneyFormatIndia(array_sum($sumamount1))}}</strong></td>
			<td></td>
			
			

			
		</tr>
	</tfoot>

		
	</table>
	
</div>

@endsection