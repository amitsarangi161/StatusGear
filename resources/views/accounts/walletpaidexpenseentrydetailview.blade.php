@extends('layouts.account')
@section('content')

<style type="text/css">

       .b {
    white-space: nowrap; 
    width: 120px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   

}
</style>
<div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped datatable1">
	<thead>
		<tr class="bg-navy" style="font-size: 10px;">
			<th>ID</th>
			<th>EMPLOYEE</th>
			<th>PROJECT</th>
			<th>CLIENT</th>
			<th>EXPENSE HEAD</th>
      <th>PARTICULAR</th>
			<th>VENDOR</th>
      <th>STATUS</th>
      <th>AMOUNT</th>
      <th>APPROVAL AMOUNT</th>
      <th>TO WALLET</th>
			<th>APPROVED BY</th>

			<th>ADDED BY</th>

			<th>FROM-TO</th>
      <th>UPLOADED FILE</th>
      <th>VIEW</th>

			

		</tr>
	</thead>
	<tbody>
    @foreach($expenseentries as $expenseentry)
		<tr style="font-size: 12px;">
        <td><a href="/viewwalletpaidexpenseentrydetails/{{$expenseentry->id}}" class="btn btn-info">{{$expenseentry->id}}</a></td>
        <td>{{$expenseentry->for}}</td>

        @if($expenseentry->projectname!='')
       <td><p class="b" title="{{$expenseentry->projectname}}">{{$expenseentry->projectname}}</p></td>
       @else
       <td><strong>OTHERS</strong></td>
       @endif
        <td>{{$expenseentry->clientname}}</td>
        <td>{{$expenseentry->expenseheadname}}</td>
        <td>{{$expenseentry->particularname}}</td>
        <td>{{$expenseentry->vendorname}}</td>
       @if($expenseentry->status=='PENDING')
        <td><span class="label label-danger">{{$expenseentry->status}}</span></td>
        @else
         <td><span class="label label-success">{{$expenseentry->status}}</span></td>
        @endif
        <td>{{$expenseentry->amount}}</td>
        <td>{{$expenseentry->approvalamount}}</td>
        <td>{{$expenseentry->towallet}}</td>
        <td>{{$expenseentry->approvedbyname}}</td>
        <td>{{$expenseentry->by}}</td>
			  @if($expenseentry->fromdate!='')

        <td>({{$expenseentry->fromdate}})-({{$expenseentry->todate}})</td>
        @else
        <td></td>
        @endif
         <td>
          <a href="{{ asset('/img/expenseuploadedfile/'.$expenseentry->uploadedfile )}}" target="_blank">
          <img style="height:70px;width:95px;" alt="click to view" src="{{ asset('/img/expenseuploadedfile/'.$expenseentry->uploadedfile )}}">
          </a>
        </td>

         <td><a href="/viewwalletpaidexpenseentrydetails/{{$expenseentry->id}}" class="btn btn-warning">VIEW</a></td>
      <!--   <td class="noprint"><a href="/editexpenseentry/{{$expenseentry->id}}" class="btn btn-primary">EDIT</a></td -->
        
        

		</tr>
    @endforeach
	</tbody>
	
</table>
</div>
@endsection