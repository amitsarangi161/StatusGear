@extends('layouts.tender')
@section('content')
@inject('provider', 'App\Http\Controllers\TenderController')
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
		<td class="text-center">APPLIED TENDERS</td>
		
	</tr>
</table>
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped datatablescroll">
	<thead>
		<tr class="bg-blue">
			<td>ID</td>
			<td>NAME OF WORK</td>
			<td>CLIENT</td>
			<td>SOURCE</td>
			<td>WORK VALUE</td>
			<td>NIT PUBLICATION DATE</td>
			<td>LAST DATE OF SUB.</td>
			<td>RFP AVAILABLE DATE</td>
			<td>CREATED AT</td>
			<td>STATUS</td>
			<td>VIEW</td>
			
		</tr>
	</thead>
	<tbody>
		@foreach($tenders as $tender)
		   
           
		   <tr>
		   	<td><a href="/viewappliedtenders/{{$tender->id}}" class="btn btn-info">{{$tender->id}}</a></td>
		   	<td><p class="b" title="{{$tender->nameofthework}}">{{$tender->nameofthework}}</p></td>
		   	<td>{{$tender->clientname}}</td>
		   	<td>{{$tender->source}}</td>
		   	<td>{{$tender->workvalue}}</td>
		   	<td data-sort="{{strtotime($tender->nitpublicationdate)}}">{{$provider::changedateformat($tender->nitpublicationdate)}}</td>
		   	<td data-sort="{{strtotime($tender->lastdateofsubmisssion)}}">{{$provider::changedateformat($tender->lastdateofsubmisssion)}}</td>
		   	<td data-sort="{{strtotime($tender->rfpavailabledate)}}">{{$provider::changedateformat($tender->rfpavailabledate)}}</td>
		   	<td data-sort="{{strtotime($tender->created_at)}}">{{$provider::changedatetimeformat($tender->created_at)}}</td>
		   	<td>
		   		<span class="label label-success">{{$tender->status}}</span>
		   	</td>
		   	<td><a href="/viewappliedtenders/{{$tender->id}}" class="btn btn-info">VIEW</a></td>
		   	
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