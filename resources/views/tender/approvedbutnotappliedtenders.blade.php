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
		<td class="text-center">NOT APPLIED TENDERS</td>
		
	</tr>
</table>
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped yajratable">
	<thead>
		<tr class="bg-blue">
			<td>ID</td>
			<td>NAME OF WORK</td>
			<td>CLIENT</td>
			<td>LOCATION</td>
			<td>SOURCE</td>
			<td>WORK VALUE</td>
			<td>NIT PUBLICATION DATE</td>
			<td>LAST DATE OF SUB.</td>
			<td>RFP AVAILABLE DATE</td>
			<td>EMD AMT</td>
			<td>CREATED AT</td>
			<td>STATUS</td>
			<td>AUTHOR</td>
			<td>VIEW</td>
			
		</tr>
	</thead>
	<tbody>
		
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
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  var table = $('.yajratable').DataTable({
        order: [[ 7, "asc" ]],
        processing: true, 
        serverSide: true,
        "scrollY": 450,
        "scrollX": true,
        "iDisplayLength": 25,
          ajax: {
            url: '{{ url("getnotappliedtenderslist")  }}',
        },
        columns: [

            {data: 'idbtn', name: 'id'},
            {data: 'now',name: 'nameofthework'},
            {data: 'clientname', name: 'clientname'},
            {data: 'location', name: 'location'},
            {data: 'source', name: 'source'},
            {data: 'workvalue', name: 'workvalue'},
            {data: 'nitpublicationdate', name: 'nitpublicationdate'},
            {data: 'ldos', name: 'lastdateofsubmisssion'},
            {data: 'rfpavailabledate', name:'rfpavailabledate'},    
            {data: 'emdamount', name:'emdamount'},    
            {name: 'created_at',data: 'created_at'},
            {data: 'sta', name: 'status'},
            {data: 'name', name: 'users.name'},
            {data: 'view', name: 'view'},
                      

          

        ]

    });
</script>
@endsection