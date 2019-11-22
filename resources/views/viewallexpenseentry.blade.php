@extends('layouts.app')
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
	
			<th>EXPENSE HEAD</th>
      <th>PARTICULAR</th>
			<th>VENDOR</th>
      <th>STATUS</th>
      <th>AMOUNT</th>
			<th>APPROVAL AMOUNT</th>
      <th>ADDED BY</th>
			<th>APPROVED BY</th>

			<th>CREATED AT</th>
      <th>UPLOADED FILE</th>
      <th>VIEW</th>
			<!-- <th class="noprint">DELETE</th> -->

		</tr>
	</thead>
	<tbody>
    @foreach($expenseentries as $expenseentry)
		<tr style="font-size: 12px;">
        <td><a href="/viewuserexpenseentrydetails/{{$expenseentry->id}}" class="btn btn-primary">{{$expenseentry->id}}</a></td>
        <td>{{$expenseentry->for}}</td>
        @if($expenseentry->projectname!='')
        <td><p class="b" title="{{$expenseentry->projectname}}">{{$expenseentry->projectname}}</p></td>
        @else
        <td><strong>OTHERS</strong></td>
        @endif
      
        <td>{{$expenseentry->expenseheadname}}</td>
        <td>{{$expenseentry->particularname}}</td>
        <td>{{$expenseentry->vendorname}}</td>
        <td>{{$expenseentry->status}}</td>
        <td>{{$expenseentry->amount}}</td>
        <td>{{$expenseentry->approvalamount}}</td>
        <td>{{$expenseentry->by}}</td>
        <td>{{$expenseentry->approvedbyname}}</td>
			  <td>{{$expenseentry->created_at}}</td>
         <td>
          <a href="{{ asset('/img/expenseuploadedfile/'.$expenseentry->uploadedfile )}}" target="_blank">
          <img style="height:70px;width:95px;" alt="click to view" src="{{ asset('/img/expenseuploadedfile/'.$expenseentry->uploadedfile )}}"></a>
        </td>
         
        <td><a href="/viewuserexpenseentrydetails/{{$expenseentry->id}}" class="btn btn-warning">VIEW</a></td>

<!--         @if($expenseentry->status=='PENDING')
        <td>
          <form action="/deleteexpenseentry/{{$expenseentry->id}}" method="post">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit" class="btn btn-danger" onclick="return confirm('Do You Want to Delete This Expense Entry');">DELETE</button>

            
          </form>
        </td>
        @else
          <td> <button type="button" class="btn btn-danger" disabled>DELETE</button></td>

        @endif -->
        

		</tr>
    @endforeach
	</tbody>
<tfoot>
    <tr class="bg-gray">
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>TOTAL EXPENSE</td>
      <td><strong>Rs.{{$expenseentries->sum('approvalamount')}}</strong></td>
      <td>TOTAL WALLET EXPENSE</td>
      <td><strong>Rs.{{$expenseentries1->sum('approvalamount')}}</strong></td>
      <td>ACCTUAL EXPENSE MADE</td>
      <td><strong>{{$expenseentries->sum('approvalamount')-$expenseentries1->sum('approvalamount')}}</strong></td>
      <td></td>
      <!-- <td></td> -->
      
    </tr>
  </tfoot>
	
</table>
</div>
@endsection