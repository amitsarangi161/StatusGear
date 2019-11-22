@extends('layouts.account')

@section('content')
@inject('provider', 'App\Http\Controllers\AccountController')
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">APPROVED DEBIT VOUCHER(APPROVED BY ADMIN)</td>
		
	</tr>
	
</table>
<div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped datatable1" style="width: 100%;">
	<thead>
		<tr class="bg-navy">
		<th>Id</th>
		<th>Vendor</th>
		<th>Bill Date</th>
		<th>Bill No</th>
		<th>Total MRP</th>
		<th>Total Discount</th>
		<th>Total Price</th>
		<th>Total Quantity</th>
		<th>Total SGST</th>
		<th>Total CGST</th>
		<th>Total IGST</th>
		<th>Total Amount</th>
		<th>IT deduction</th>
		<th>Other deduction</th>
		<th>Final Amount</th>
		<th>Approval Amount</th>
		<th>Paid Amount</th>
		<th>Inv. Scan</th>
		<th>Status</th>
		<th>View</th>
		</tr>

	</thead>
	<tbody>
		@foreach($debitvoucherarr as $debitvoucher)
          <tr>
          	<td><a href="/viewapproveddebitvoucher/{{$debitvoucher['data']['id']}}" target="_blank" class="btn btn-primary">{{$debitvoucher['data']['id']}}</a></td>
          	<td>{{$debitvoucher['data']['vendorname']}}</td>
          	<td>{{$debitvoucher['data']['billdate']}}</td>
          	<td>{{$debitvoucher['data']['billno']}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher['data']['tmrp'])}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher['data']['tdiscount'])}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher['data']['tprice'])}}</td>
          	<td>{{$debitvoucher['data']['tqty']}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher['data']['tsgst'])}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher['data']['tcgst'])}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher['data']['tigst'])}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher['data']['totalamt'])}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher['data']['itdeduction'])}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher['data']['otherdeduction'])}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher['data']['finalamount'])}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher['data']['approvalamount'])}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher['paid'])}}</td>
          	<td>
          		 <a href="{{asset('img/debitvoucher/'.$debitvoucher['data']['invoicecopy'])}}" target="_blank">
          		<img style="height:50px;width:50px;" src="{{asset('img/debitvoucher/'.$debitvoucher['data']['invoicecopy'])}}" alt="click here" id="imgshow">
          	</a>
          	
          	</td>
          	<td>{{$debitvoucher['data']['status']}}</td>
          	<td><a href="/viewapproveddebitvoucher/{{$debitvoucher['data']['id']}}" target="_blank" class="btn btn-primary">View</a></td>
          </tr>

		@endforeach
	</tbody>

</table>
</div>

@endsection