@extends('layouts.account')
@section('content')

<table class="table">
	<tr class="bg-blue">
		<td class="text-center">REQUISITION PAYMENT FROM BANK <strong>{{$bankname}}</strong></td>
	</tr>
	 
</table>

<table class="table table-responsive table-hover table-bordered table-striped datatable">
     <thead>
     	<tr class="bg-navy">
     		<th>ID</th>
        <th>REQUISITION ID</th>
     		<th>NAME</th>
     		<th>AMOUNT</th>
     		<th>PAYMENT TYPE</th>
     		<th>REMARKS</th>
     		<th>PAYMENT STATUS</th>
     		<th>CREATED_AT</th>
        <th>PAY TO</th>
     		<th>VIEW</th>


     	</tr>
	
     </thead>
     <tbody>
     	@foreach($requisitionpayments as $requisitionpayment)
           <tr>
           	  <td>{{$requisitionpayment->id}}</td>
              <td>{{$requisitionpayment->rid}}</td>
           	  <td>{{$requisitionpayment->name}}</td>
           	  <td>{{$requisitionpayment->amount}}</td>
           	  <td>{{$requisitionpayment->paymenttype}}</td>
           	  <td>{{$requisitionpayment->remarks}}</td>
           	  <td>{{$requisitionpayment->paymentstatus}}</td>
           	  <td>{{$requisitionpayment->created_at}}</td>
              <td>{{$requisitionpayment->type}}</td>
           	  <!-- <td><button type="button" class="btn btn-primary" onclick="payonline('{{$requisitionpayment->id}}');">PAID</button></td> -->
              <td><a href="/cashierviewdetailsonlinepayment/{{$bankname}}/{{$requisitionpayment->id}}" class="btn btn-primary">VIEW</a></td>
           </tr>

     	@endforeach
     </tbody>
</table>



@endsection