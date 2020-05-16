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
            <td>LIVE/EXP</td>
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
          <td><strong>Select a Status</strong></td>
          <td>
         <select class="form-control" name="status" required="">
              <option value="">Select a Status</option>
                              <option value="ASSIGNED TO USER">ASSIGNED TO USER</option>
                              <option value="ELLIGIBLE">TO COMMITTEE</option>
                              
                            
            </select>
          </td>
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

  $(function () {

    

    var table = $('.yajratable').DataTable({
        order: [[ 0, "desc" ]],
        processing: true, 
        serverSide: true,
        "scrollY": 450,
        "scrollX": true,
        "iDisplayLength": 25,
        ajax: "{{ route('getviewalltenderlist') }}",
        columns: [

            {data: 'idbtn', name: 'id'},
            {data: 'now',name: 'nameofthework'},
            {data: 'clientname', name: 'clientname'},
            {data: 'source', name: 'source'},
            {data: 'workvalue', name: 'workvalue'},
            {data: 'nitpublicationdate', name: 'nitpublicationdate'},
            {data: 'ldos', name: 'lastdateofsubmisssion'},
            {data: 'live', name: 'lastdateofsubmisssion'},
            {data: 'rfpavailabledate', name:'rfpavailabledate'},
            {name: 'created_at',data: 'created_at'},
            {data: 'sta', name: 'sta'},
            {data: 'name', name: 'users.name'},
            {data: 'view', name: 'view'},
            {data: 'edit', name: 'edit'},
            

          

        ]

    });

    

  });

  function revokestatus(id)
  {
       $("#tid").val(id);
       $('#revokeModal').modal('show');
  }
  </script>
@endsection