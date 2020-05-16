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

@-webkit-keyframes blink {
    100% {
        background: rgba(255, 0, 0, 0.5);
    }
}
@-moz-keyframes blink {
    100% {
        background: rgba(255, 0, 0, 0.5);
    }
}
@keyframes blink {
    100% {
        background: rgba(255, 0, 0, 0.5);
    }
}
.blink {
    -webkit-animation-direction: normal;
    -webkit-animation-duration: 30s;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-name: blink;
    -webkit-animation-timing-function: linear;
    -moz-animation-direction: normal;
    -moz-animation-duration: 30s;
    -moz-animation-iteration-count: infinite;
    -moz-animation-name: blink;
    -moz-animation-timing-function: linear;
    animation-direction: normal;
    animation-duration: 30s;
    animation-iteration-count: infinite;
    animation-name: blink;
    animation-timing-function: linear;
}
table {
    width: 100%;
}

</style>
<table class="table">
    <tr class="bg-navy">
        <td class="text-center">CURRENT TENDER LIST</td>
        
    </tr>
</table>
 <form method="POST" id="search-form" class="form-inline" role="form">
<table class="table">
    <tr>
        <td>Select A Status</td>
        <td>
            <select name="status" id="status" class="form-control select2" required="">
            <option value="">Select A Status</option>
            @foreach($statuses as $status)
             <option value="{{$status->status}}">{{$status->status}}</option>

             @endforeach   
            </select>
        </td>
        <td>
            <button type="submit" class="btn btn-primary">FILTER</button>
        </td>
    </tr>
    
</table>
</form>
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped yajratable">
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
            <td>AUTHOR</td>
            <td>VIEW</td>
            <td>EDIT</td>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
</div>

<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">


 $('#search-form').on('submit', function(e) {
        e.preventDefault();
       
       table.draw(true);
       
    });


    

    var table = $('.yajratable').DataTable({
        order: [[ 6, "asc" ]],
        processing: true, 
        serverSide: true,
        "scrollY": 450,
        "scrollX": true,
        "iDisplayLength": 25,
          ajax: {
            url: '{{ url("gettenderlist")  }}',
            data: function (d) {
                d.status = $('#status').val();
               
            }
        },
        columns: [

            {data: 'idbtn', name: 'id'},
            {data: 'now',name: 'nameofthework'},
            {data: 'clientname', name: 'clientname'},
            {data: 'source', name: 'source'},
            {data: 'workvalue', name: 'workvalue'},
            {data: 'nitpublicationdate', name: 'nitpublicationdate'},
            {data: 'ldos', name: 'lastdateofsubmisssion'},
            {data: 'rfpavailabledate', name:'rfpavailabledate'},
            {name: 'created_at',data: 'created_at'},
            {data: 'sta', name: 'sta'},
            {data: 'name', name: 'users.name'},
            {data: 'view', name: 'view'},
            {data: 'edit', name: 'edit'},
            

          

        ]

    });


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
                    table.ajax.reload();
               }
               
             });
       
    }
else {
  
} 
}
      
           

  
 
  </script>
@endsection