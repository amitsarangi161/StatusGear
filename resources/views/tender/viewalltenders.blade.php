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
        <td class="text-center">VIEW ALL TENDERS</td>
        
    </tr>
</table>
<table class="table">
    <tr>
      <form method="POST" id="search-form1" class="form-inline" role="form">
        <td>
         
          <button type="submit" value="" name="all" id="all" class="btn btn-primary btn-lg">ALL</button>
        </td>
      </form>
      <form method="POST" id="search-form2" class="form-inline" role="form">
        <td><button type="submit" value="" name="live" id="live" class="btn btn-success btn-lg">LIVE</button></td>
      </form>
      <form method="POST" id="search-form3" class="form-inline" role="form">
        <td><button type="submit" value="" name="expired" id="expired" class="btn btn-danger btn-lg">EXPIRED</button></td>
        </form>
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
            <td>TENDER REF NO</td>
            <td>WORK VALUE</td>
            <td>LAST DATE OF SUB.</td>
            <td>LIVE/EXP</td>
            <td>RFP AVAILABLE DATE</td>
            <td>EMD AMT</td>
            <td>STATUS</td>
            <td>AUTHOR</td>
            <td>VIEW</td>
            <td>EDIT</td>
            <td>CREATED AT</td>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
</div>
@if(Auth::user()->usertype=='MASTER ADMIN')
<div id="revokeModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CHANGE STATUS</h4>
      </div>
      <div class="modal-body">
        <form action="/revokestatus" method="POST">
          {{csrf_field()}}
        <table class="table">
          <input type="hidden" name="tid" id="tid" required="">
          <tr>
          <td><strong>Select a Status</strong></td>
          <td>
         <select class="form-control" name="status" required="">
              <option value="">Select a Status</option>
                              <option value="ASSIGNED TO USER">ASSIGNED TO USER</option>
                              <option value="ELLIGIBLE">TO COMMITTEE</option>
                              
                            
            </select>
          </td>
          </tr>
          <tr>
            <td><strong>REMARKS</strong></td>
            <td>
              <textarea name="remarks" class="form-control" required=""></textarea>
            </td>
          </tr>
          <td>
            <button type="submit" class="btn btn-success" onclick="confirm('Do You want to change this ?')">CHANGE</button>
          </td>
          
        </table>
        </form>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@endif
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">

     $('#search-form1').on('submit', function(e) {

        e.preventDefault();
         $("#live").val('');
         $("#expired").val('');
        $("#all").val("ALL");
       
       table.draw(true);
       
    }); $('#search-form2').on('submit', function(e) {
        e.preventDefault();
         $("#expired").val('');
        $("#all").val('');
       $("#live").val("LIVE");

       table.draw(true);
       
    }); $('#search-form3').on('submit', function(e) {
        e.preventDefault();
        $("#all").val('');
       $("#live").val('');
       $("#expired").val("EXPIRED");
     
       table.draw(true);
       
    });



    

    var table = $('.yajratable').DataTable({
        order: [[ 0, "desc" ]],
        processing: true, 
        serverSide: true,
        "scrollY": 450,
        "scrollX": true,
        "iDisplayLength": 25,
         ajax: {
            url: '{{ url("getviewalltenderlist")  }}',
            data: function (d) {
                d.all = $('#all').val();
                d.live = $('#live').val();
                d.expired = $('#expired').val();
               
            }
        },
        columns: [

            {data: 'idbtn', name: 'id'},
            {data: 'now',name: 'nameofthework'},
            {data: 'clientname', name: 'clientname'},
            {data: 'location', name: 'location'},
            {data: 'tenderrefno', name: 'tenderrefno'},
            {data: 'workvalue', name: 'workvalue'},
            {data: 'ldos', name: 'lastdateofsubmisssion'},
            {data: 'live', name: 'lastdateofsubmisssion'},
            {data: 'rfpavailabledate', name:'rfpavailabledate'},
            {data: 'emdamount', name:'emdamount'},
            {data: 'sta', name: 'sta'},
            {data: 'name', name: 'users.name'},
            {data: 'view', name: 'view'},
            {data: 'edit', name: 'edit'},
            {name: 'created_at',data: 'created_at'},
            

          

        ]

    });

    




  function revokestatus(id)
  {
       $("#tid").val(id);
       $('#revokeModal').modal('show');
  }
  </script>
@endsection