@extends('layouts.tender')
@section('content')
@inject('provider', 'App\Http\Controllers\TenderController')
@inject('tend', 'App\Http\Controllers\AccountController')
<style type="text/css">
    .b {
    white-space: nowrap; 
    width: 120px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}

</style>
<table class="table">
	<tr class="bg-navy">
		<td class="text-center">POST TENDER DOCUMENT UPLOAD</td>
		
	</tr>
</table>
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped datatablescroll">
	<thead>
		<tr class="bg-blue">
			<td>ID</td>
			<td>NAME OF WORK</td>
			<td>CLIENT</td>
			<td>LOCATION</td>
			<td>TENDER REF NO</td>
			<td>WORK VALUE</td>
			<td>LAST DATE OF SUB.</td>
			<td>RFP AVAILABLE DATE</td>
			<td>EMD AMT</td>
			<td>CREATED AT</td>
			<td>STATUS</td>
			<td>TS</td>
			<td>FS</td>
			<td>TP</td>
			<td>FP</td>
			<td>PARTICIPANT</td>
			<td>AUTHOR</td>
			<td>VIEW</td>
			
		</tr>
	</thead>
	<tbody>
		@foreach($tenders as $tender)
		   
           
		   <tr>
		   	<td><a href="/viewposttenderupload/{{$tender->id}}" class="btn btn-info">{{$tender->id}}</a></td>
		   	<td><p class="b" title="{{$tender->nameofthework}}">{{$tender->nameofthework}}</p></td>
		   	<td>{{$tender->clientname}}</td>
		   	<td>{{$tender->location}}</td>
		   	<td>{{$tender->tenderrefno}}</td>
		   	<td>{{$tender->workvalue}}</td>
		   	
		   	<td data-sort="{{strtotime($tender->lastdateofsubmisssion)}}"><span class="label label-danger btn btn-lg" style="font-size: 12px;">{{$provider::changedateformat($tender->lastdateofsubmisssion)}}</span></td>
		   	<td data-sort="{{strtotime($tender->rfpavailabledate)}}"><a href="/viewassignedtenderoffice/{{$tender->id}}">{{$provider::changedateformat($tender->rfpavailabledate)}}</a></td>
		   	<td>{{$tend::moneyFormatIndia($tender->emdamount)}}</td>
		   	<td data-sort="{{strtotime($tender->created_at)}}">{{$provider::changedatetimeformat($tender->created_at)}}</td>
		   	<td>
		   		<span class="label label-success">{{$tender->status}}</span>
		   	</td>
		   	@if($tender->technicalscoreupload != "")
		   	<td> <a href="/img/posttenderdoc/{{$tender->technicalscoreupload}}" target="_blank"><i style="color: green;font-size: 20px;" class='fa fa-check-circle-o'></i></a></td>
		   	@else
		   	<td><i style="color: red;font-size: 20px;" class='fa fa-times-circle-o'> </i></td>
		   	@endif
		   	@if($tender->financialscoreupload != "")
		   	<td><a href="/img/posttenderdoc/{{$tender->financialscoreupload}}" target="_blank"> <i style="color: green;font-size: 20px;" class='fa fa-check-circle-o'></i></a></td>
		   	@else
		   	<td><i style="color: red;font-size: 20px;" class='fa fa-times-circle-o'> </i></td>
		   	@endif
		   	@if($tender->technicalproposal != "")
		   	<td><a href="/img/posttenderdoc/{{$tender->technicalproposal}}" target="_blank"> <i style="color: green;font-size: 20px;" class='fa fa-check-circle-o'></i></a></td>
		   	@else
		   	<td><i style="color: red;font-size: 20px;" class='fa fa-times-circle-o'> </i></td>
		   	@endif
		   	@if($tender->financialproposal != "")
		   	<td><a href="/img/posttenderdoc/{{$tender->financialproposal}}" target="_blank"><i style="color: green;font-size: 20px;" class='fa fa-check-circle-o'></i></a></td>
		   	@else
		   	<td><i style="color: red;font-size: 20px;" class='fa fa-times-circle-o'> </i></td>
		   	@endif
		   	@if($tender->participantlistupload != "")
		   	<td><a href="/img/posttenderdoc/{{$tender->participantlistupload}}" target="_blank"><i style="color: green;font-size: 20px;" class='fa fa-check-circle-o'></i></a></td>
		   	@else
		   	<td><i style="color: red;font-size: 20px;" class='fa fa-times-circle-o'> </i></td>
		   	@endif
		   	<td>{{$tender->name}}</td>
		   	<td><a href="/viewposttenderupload/{{$tender->id}}" class="btn btn-info">VIEW</a></td>
		   	
		   </tr>

		@endforeach
	</tbody>
</table>
</div>
<script type="text/javascript">
	function changestatus(value,id)
    { 
var r = confirm("Do You Want to chnage status to "+ value +"?");
if (r == true) {

   $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxchangetenderstatus")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     status:value,
                     id:id,
                     
                     },

               success:function(data) { 
                    window.location.reload();
               }
               
             });
       
    }
else {
  
} 
}
</script>
@endsection