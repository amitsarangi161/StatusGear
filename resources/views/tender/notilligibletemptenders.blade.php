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
		<td class="text-center">TEMP TENDERS</td>
		
	</tr>
</table>
 <button class="btn btn-success" type="button" onclick="openimport();">Import</button>
 <a href="/sample-tender.xlsx" download>
 	<button class="btn"><i class="fa fa-download"></i>Sample Download</button>
 </a>

<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped yajratable">
	<thead>
		<tr class="bg-blue">
			<td>ID</td>
			<td>T247ID</td>
			<td>NAME OF WORK</td>
			<td>CLIENT</td>
			<td>LOCATION</td>
			<td>TENDER REF NO</td>
			<td>WORK VALUE</td>
			<td>ACTION</td>
			<td>LAST DATE OF SUB.</td>
			<td width="10%">TENDER WEBSITE</td>
			<td width="10%">TENDER REF LINK</td>
			<td>STATUS</td>
			
			
		</tr>
	</thead>
	<tbody>
		
	</tbody>
</table>
</div>

<div class="modal fade in" id="importmodal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <form method="post" enctype="multipart/form-data" action="/importtender">
      <div class="modal-header bg-navy">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: #fff;">×</span>
      </button>
        <h4 class="modal-title text-center">Upload Tender Excel</h4>
      </div>
      <div class="modal-body">
        
              
                {{ csrf_field() }}
                <div class="form-group">
                <label>Select File for Upload Tender</label>
                    <input type="file" name="select_file" />
                    <span class="text-muted">.xls, .xslx</span>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success btn-flat">Upload</button>
      </div>
        </form>
    </div>
  </div>
</div>


<script type="text/javascript">

	 function openimport()
    {
        $("#importmodal").modal('show');
    }

	function changestatus(value,id)
    { 
    	


   $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxchangetemptenderstatus")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     status:value,
                     id:id,
                     
                     },

               success:function(data) { 

               	  id='#tid'+data;
               	  
               	  //$(id).html('');
                    
               }
               
             });
       
    }

</script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  var table = $('.yajratable').DataTable({
        order: [[ 8, "asc" ]],
        processing: true, 
        serverSide: true,
        "scrollY": 450,
        "scrollX": true,
        "iDisplayLength": 25,
          ajax: {
            url: '{{ url("getnotilligibletemplist")  }}',
        },
        columns: [

            {data: 'id', name: 'id'},
            {data: 'tendersiteid', name: 'tendersiteid'},
            {data: 'now',name: 'nameofthework'},
            {data: 'clientname', name: 'clientname'},
            {data: 'location', name: 'location'},
            {data: 'tenderrefno', name: 'tenderrefno'},
            {data: 'workvalue', name: 'workvalue'},
            {data: 'tempid', name: 'action',searchable: false, sortable : false},
            {data: 'ldos', name: 'lastdateofsubmisssion'},        
            {data: 'tender_website', name:'tender_website'},    
            {data: 'tender_site_ref', name:'tender_site_ref'},    
            {data: 'status', name: 'status',searchable: false, sortable : false},

          

        ]

    });
</script>
@endsection