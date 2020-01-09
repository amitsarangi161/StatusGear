@extends('layouts.account')
@section('content')
<style type="text/css">
    .b {
    white-space: nowrap; 
    width: 250px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style>
<table  class="table" id="resultsTable">
  <tr class="bg-blue">
    <td class="text-center">LEDGER</td>
  </tr>
</table>
<table  class="table table-responsive table-hover table-bordered table-striped">
	<form action="/ledger/ledger" method="get">
	<tr>
		<td width="10%"><strong>Select a Users</strong></td>
		<td width="30%">

			<select class="form-control select2" name="user">
				<option value="">Select a User</option>
				@foreach($users as $user)
				<option value="{{$user->id}}" {{ ( $user->id == Request::get('user')) ? 'selected' : '' }}>{{$user->name}}</option>
				@endforeach
				
			</select>
		</td>
		<td width="10%">
			<strong>Select a Project</strong>
		</td>
		<td width="40%">
			<select class="form-control select2" name="project">
				<option value="">select a project</option>
                  <option value="OTHERS" title="OTHERS" {{ (Request::get('project')=="OTHERS") ? 'selected' : '' }}>OTHERS</option>
      	 	@foreach($projects as $project)

              
             <option value="{{$project->id}}" {{ ( $project->id == Request::get('project')) ? 'selected' : '' }}>{{$project->projectname}}</option>
         

            
           
		   @endforeach
			</select>
		</td>
	
		<td width="10%"><button type="submit" class="btn btn-info">FETCH LEDGER</button></td>
	</tr>
	</form>
	
</table>

@if($requisitionpayments)
<p style="text-align:center;">CASH BOOK</p>

<table width="100%">
<tbody><tr style="border-bottom:1px solid;text-align: center;background: #383b3e;color: #fff;line-height: 2em;">
<td style="width: 100%;">PAYMENT</td>



</tr>


</tbody>
</table>


<table  width="100%">

<tbody>

<tr style="background: #c0c0c0;height: 2.5em;font-size: 1em;border-bottom: 1px black solid; font-weight: bold;">
<td style="width: 10%; text-align:left;">
DATE</td>
<td style="width: 40%; text-align:left;">
PROJECT</td>
<td style="width: 10%; text-align:left;">
PAYMENT TYPE</td>
<td style="width: 10%; text-align:left;">
EXP HEAD</td>
<td style="width: 10%; text-align:right;">
CREDIT</td>
<td style="width: 10%; text-align:right;">
DEBIT</td>
<td style="width: 10%; text-align:right;">
BALANCE</td>
</tr>

@php
  $start=0;
  $totalpaid=0;
  $totalexp=0;
@endphp
@foreach($customarr as $arr)
@php
  
  $start+=$arr['payment']['amount'];
  $totalpaid+=$arr['payment']['amount'];
@endphp
<tr style="line-height: 2em;font-weight: bold;" class="noexcel">
<tr>
	<td style="width: 10%; text-align:left;">{{$arr['payment']['dateofpayment']}}</td>

	@if($arr['payment']['projectname']!='')
	<td style="width: 40%; text-align:left;"><p class="b" title="{{$arr['payment']['projectname']}}">{{$arr['payment']['projectname']}}</p></td>
	@else
    <td style="width: 40%; text-align:left;">OTHERS</td>
	@endif
	<td style="width: 10%; text-align:left;">{{$arr['payment']['paymenttype']}}</td>
	<td style="width: 10%; text-align:left;"></td>
	<td style="width: 10%; text-align:right;">{{$arr['payment']['amount']}}</td>
	<td style="width: 10%; text-align:right;">0</td>
	<td style="width: 10%; text-align:right;">{{$start}}</td>
</tr>
<tr style="font-weight: bold;border-top: 1px dashed;background: #e8e8e8;line-height: 3em;" class="noexcels">
 @foreach($arr['expenses'] as $exp)
@php
  $abc=$start;
  $getexp=$abc-$exp->approvalamount;
  $totalexp+=$exp->approvalamount;
@endphp
<tr style="background-color: #ffb3b3;">
	<td style="width: 10%; text-align:left;">{{$exp->created_at}}</td>
	@if($exp->projectname!='')
	<td style="width: 40%; text-align:left;"><p class="b" title="{{$exp->projectname}}">{{$exp->projectname}}</p></td>
	@else
     <td style="width: 40%; text-align:left;">OTHERS</td>
	@endif
	<td style="width: 10%; text-align:left;">NULL</td>
	<td style="width: 10%; text-align:left;">{{$exp->expenseheadname}}</td>
	<td style="width: 10%; text-align:right;">0</td>
	<td style="width: 10%; text-align:right;">{{$exp->approvalamount}}</td>
	<td style="width: 10%; text-align:right;">{{$getexp}}</td>
</tr>
@php
   $abc=$getexp;
   $start=$abc;
@endphp
@endforeach

@endforeach







</tbody>
<tr style="font-weight: bold;border-top: 1px dashed;background: #e8e8e8;line-height: 3em;">
<tfoot>

<tr style="background-color: red;">
	<td style="width: 10%; text-align:left;"></td>
    <td style="width: 40%; text-align:left;"></td>
	<td style="width: 10%; text-align:left;"></td>
	<td style="width: 10%; text-align:left;">TOTAL</td>
	<td style="width: 10%; text-align:right;">{{$totalpaid}}</td>
	<td style="width: 10%; text-align:right;">{{$totalexp}}</td>
	<td style="width: 10%; text-align:right;"></td>
</tr>



</tfoot>

</table>


@endif





@endsection