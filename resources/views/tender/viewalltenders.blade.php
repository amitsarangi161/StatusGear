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
.greenRow{
    background-color: #8eff8e !important;
}
.yellowRow{
    background-color: #ffcb00!important;
}
.lightRow{
    background-color: #d2d2d2!important;
}

</style>
<style type="text/css">
  .center {
 width:85%;
 padding: 25px;
margin: 0 auto;
border: 1px solid #ccc;
margin-bottom: 25px;
}
.box45{display:inline-block;width: 100%;
margin: 0 auto;}
.padboth{padding-left: 5px;
padding-right: 5px;}
/** Custom Select **/
.custom-select-wrapper {
  position: relative;
  display: inline-block;
  user-select: none;
  width: 100%;
}
  .custom-select-wrapper select {
    display: none;
  }
  .custom-select.ff {
    position: relative;
    display: inline-block;
  padding: 0;
  border-radius: 3px;
  height: 37px;
  }
    .custom-select-trigger {
      position: relative;
      display: block;
      width: 100%;
      padding: 0 84px 0 22px;
      font-size: 14px;
      font-weight: 500;
      color: #686868;
      line-height: 35px;
      background: #f2f2f2;
      border-radius: 2px;
      cursor: pointer;
    }
      .custom-select-trigger:after {
        position: absolute;
        display: block;
        content: '';
        width: 10px; height: 10px;
        top: 50%; right: 25px;
        margin-top: -3px;
        border-bottom: 1px solid #057ba9;
    border-right: 1px solid #057ba9;
        transform: rotate(45deg) translateY(-50%);
        transition: all .4s ease-in-out;
        transform-origin: 50% 0;
    
      }
      .custom-select.ff.opened .custom-select-trigger:after {
        margin-top: 3px;
        transform: rotate(-135deg) translateY(-50%);
      }
  .custom-options {
    position: absolute;
    display: block;
    top: 100%; left: 0; right: 0;
    min-width: 100%;
    margin: 15px 0;
    border: 1px solid #b5b5b5;
    border-radius: 4px;
    box-sizing: border-box;
    box-shadow: 0 2px 1px rgba(0,0,0,.07);
    background: #151414;
    transition: all .4s ease-in-out;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transform: translateY(-15px);
  z-index: 9;
  }
  .custom-select.ff.opened .custom-options {
    opacity: 1;
    visibility: visible;
    pointer-events: all;
    transform: translateY(0);
  }
    .custom-options:before {
      position: absolute;
      display: block;
      content: '';
      bottom: 100%; right: 25px;
      width: 7px; height: 7px;
      margin-bottom: -4px;
      border-top: 1px solid #413e3e;
      border-left: 1px solid #413e3e;
      background: #413e3e;
      transform: rotate(45deg);
      transition: all .4s ease-in-out;
    }
    .option-hover:before {
      background: #f9f9f9;
    }
    .custom-option {
      position: relative;
display: block;
padding: 0 22px;
border-bottom: 1px solid #383838;
font-size: 15px;
font-weight: 400;
color: #fff;
line-height: 42px;
cursor: pointer;
transition: all .4s ease-in-out;
    }
    .custom-option:first-of-type {
      border-radius: 4px 4px 0 0;
    }
    .custom-option:last-of-type {
      border-bottom: 0;
      border-radius: 0 0 4px 4px;
    }
    .custom-option:hover,
    .custom-option.selection {
      background: #1d1d1d;
    }
</style>

<table class="table">
    <tr class="bg-navy">
        <td class="text-center">VIEW ALL TENDERS</td>
        
    </tr>
</table>

<div class="center">
<div class="row">

<div class="col-md-4 padboth">
<div class="form-group">
<label><img src="{{asset('filter/live.png')}}" style="width:18px;margin-right:4px;">Live/Expire</label>
  <select name="sources" id="sources" class="form-control custom-select ff sources" placeholder="Select">
    <option value="">SELECT</option>
    <option value="profile">All</option>
    <option value="word">Live</option>
    <option value="hashtag">Expired</option>
  </select>
  </div>
  </div>
   <div class="col-md-4 padboth">
<div class="form-group">
<label><img src="{{asset('filter/status.png')}}" style="width:18px;margin-right:4px;">Status</label>
  <select name="sources" id="sources" class="form-control select2 custom-select ff sources" placeholder="Select" multiple="">
    <option value="">SELECT</option>
    @foreach($statuses as $status)
                   <option value="{{$status->status}}">{{$status->status}}</option>

    @endforeach
  </select>
  </div>
  </div>
  <div class="col-md-4 padboth">
<div class="form-group">
<label><img src="{{asset('filter/evalue.png')}}" style="width:18px;margin-right:4px;">Evaluation</label>
  <select name="sources" id="sources" class="form-control custom-select ff sources" placeholder="Select">
    <option >SELECT</option>
    <option value="TECHNICAL BID OPENING">TECHNICAL BID OPENING</option>
    <option value="TECHNICAL EVALUATION">TECHNICAL EVALUATION</option>
    <option value="Financial EVALUATION">Financial EVALUATION</option>
    <option value="TECHNICAL BID OPENING">TECHNICAL BID OPENING</option>
    <option value="AOC">AOC</option>
    <option value="RETENDER">RETENDER</option>
    <option value="CANCELLED">CANCELLED</option>
  </select>
  </div>
  </div>

  </div>

  <div class="row">

<div class="col-md-4 padboth">
<div class="form-group">
<label><img src="{{asset('filter/date.png')}}" style="width:18px;margin-right:4px;">Date (From)</label>
  <div><input type="text" class="form-control datepicker" name=""></div>
  </div>
  </div>
  <div class="col-md-4 padboth">
<div class="form-group">
<label><img src="{{asset('filter/date.png')}}"style="width:18px;margin-right:4px;"> Date (To)</label>
  <div><input type="text" class="form-control datepicker" name=""></div>
  </div>
  </div>
  <div class="col-md-4 padboth">
<div class="form-group">
<label><img src="{{asset('filter/date1.png')}}" style="width:18px;margin-right:4px;">Date Type</label>
  <select name="sources" id="sources" class="form-control custom-select ff sources" placeholder="Select">
    <option value="profile">SELECT</option>
    <option value="word">BID SUBMISSION DATE</option>
    <option value="word">RFP/NIT AVAILABLE DATE</option>
    <option value="word">PRE-BID CLARIFICATION DATE</option>
    <option value="word">PRE-BID MEETING DATE</option>
    <option value="hashtag">TENDER UPLOAD DATE</option>
  </select>
  </div>
  </div>
  </div>
  <div class="row">
  <div class="text-center box45">
  <button type="submit" class="btn btn-primary"><img src="{{asset('filter/check.png')}}" style="width:18px;">Filter</button>
  <button type="submit" class="btn btn-danger"><img src="{{asset('filter/check.png')}}" style="width:18px;">Clear</button>
  </div>
  </div>
  </div>
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped yajratable">
    <thead>
        <tr class="bg-blue">
            <td>ID</td>
            <td>TENDER SOURCE ID</td>
            <td>TENDER REF NO</td>
            <td>NAME OF WORK</td>
            <td>CLIENT</td>
            <td>LOCATION</td>
            <td title="Tender Inviting Authority">TIA</td>
            <td>WORK VALUE</td>
            <td>LAST DATE OF SUB.</td>
            <td>OPENING DT</td>
            <td>LIVE/EXP</td>
            <td>RFP AVAILABLE DATE</td>
            <td>EMD AMT</td>
            <td>STATUS</td>
            <td>NIT AND RFP</td>
            <td>CORRIGENDUM</td>
            <td>APPLIED AS</td>
            <td>COMMENTS VIEW</td>
            <td>NO OF PARTICIPANT</td>
            <td>PARTICIPANT LIST</td>
            <td>AWARDED TO</td>
            <td>AGREEMENT VALUE</td>
            <td>AUTHOR</td>
            <td>VIEW</td>
            <td>EDIT</td>
            <td>CREATED AT</td>
            <td>UPDATED AT</td>
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
        $("#applied").val('');
        $("#technical").val('');
       $("#financial").val('FE');
       $("#ei").val('');
       $("#ni").val('');
       
       table.draw(true);
       
    }); $('#search-form2').on('submit', function(e) {
        e.preventDefault();
         $("#expired").val('');
        $("#all").val('');
        $("#applied").val('');
       $("#live").val("LIVE");
       $("#technical").val('');
       $("#financial").val('');
       $("#ei").val('');
       $("#ni").val('');

       table.draw(true);
       
    }); $('#search-form3').on('submit', function(e) {
        e.preventDefault();
        $("#all").val('');
       $("#live").val('');
       $("#applied").val('');
       $("#expired").val("EXPIRED");
       $("#technical").val('');
       $("#financial").val('');
       $("#ei").val('');
       $("#ni").val('');
     
       table.draw(true);
       
    });
    $('#search-form4').on('submit', function(e) {
        e.preventDefault();
        $("#all").val('');
       $("#live").val('');
       $("#expired").val('');
       $("#applied").val('APPLIED');
       $("#technical").val('');
       $("#financial").val('');
       $("#ei").val('');
       $("#ni").val('');
     
       table.draw(true);
       
    });  
    $('#search-form5').on('submit', function(e) {
        e.preventDefault();
        $("#all").val('');
       $("#live").val('');
       $("#expired").val('');
       $("#applied").val('');
       $("#technical").val('TE');
       $("#financial").val('');
       $("#ei").val('');
       $("#ni").val('');

     
       table.draw(true);
       
    });
      $('#search-form6').on('submit', function(e) {
        e.preventDefault();
        $("#all").val('');
       $("#live").val('');
       $("#expired").val('');
       $("#applied").val('');
       $("#technical").val('');
       $("#financial").val('FE');
       $("#ei").val('');
       $("#ni").val('');
     
       table.draw(true);
       
    });
         $('#search-form7').on('submit', function(e) {
        e.preventDefault();
        $("#all").val('');
       $("#live").val('');
       $("#expired").val('');
       $("#applied").val('');
       $("#technical").val('');
       $("#financial").val('');
       $("#ei").val('EI');
       $("#ni").val('');
     
       table.draw(true);
       
    });

  $('#search-form8').on('submit', function(e) {
        e.preventDefault();
        $("#all").val('');
       $("#live").val('');
       $("#expired").val('');
       $("#applied").val('');
       $("#technical").val('');
       $("#financial").val('');
       $("#ei").val('');
       $("#ni").val('NI');
     
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
                d.applied = $('#applied').val();
                d.technical = $('#technical').val();
                d.financial = $('#financial').val();
                d.ei = $('#ei').val();
                d.ni = $('#ni').val();
               
            }
        },
        columns: [

            {data: 'idbtn', name: 'id'},
            {data: 'tendersiteidlink', name: 'tendersiteid'},
             {data: 'tenderrefnolink', name: 'tenderrefno'},
            {data: 'now',name: 'nameofthework'},
            {data: 'clientname', name: 'clientname'},
            {data: 'location', name: 'location'},
            {data: 'tia', name: 'tia', searchable: false, sortable : false},
            {data: 'workvalue', name: 'workvalue'},
            {data: 'ldos', name: 'lastdateofsubmisssion'},
            {data: 'openingdate',name: 'openingdate', searchable: false, sortable : false},
            {data: 'live', name: 'lastdateofsubmisssion'},
            {data: 'rfpavailabledatelink', name:'rfpavailabledate'},
            {data: 'emdamount', name:'emdamount'},
            {data: 'sta', name: 'sta'},
            {data: 'nitandrfp', name: 'nitandrfp',searchable: false, sortable : false},
            {data: 'corrigendum', name: 'corrigendum',searchable: false, sortable : false},
            {data: 'recomended', name: 'recomended'},
            {data: 'commentview', name: 'commentview',searchable: false, sortable : false},
            {data: 'noofparticipant', name: 'noofparticipant',searchable: false, sortable : false},
            {data: 'participantlist', name: 'participantlist',searchable: false, sortable : false},
            {data: 'awardedto', name: 'awardedto',searchable: false, sortable : false},
            {data: 'agreementvalue', name: 'agreementvalue',searchable: false, sortable : false},
            
            {data: 'name', name: 'users.name'},
            {data: 'view', name: 'view'},
            {data: 'edit', name: 'edit'},
            {name: 'created_at',data: 'created_at'},
            {name: 'updated_at',data: 'updated_at'},
            

          

        ],
        "createdRow": function (row, data, index) {
             if (data.status == "ELLIGIBLE,INTERESTED") {
                 $(row).addClass('greenRow');
             }
             if (data.status == "ELLIGIBLE,NOT INTERESTED") {
                 $(row).addClass('yellowRow');
             }
              if (data.status == "NOT ELLIGIBLE,INTERESTED") {
                 $(row).addClass('lightRow');
             }
         }

    });

    




  function revokestatus(id)
  {
       $("#tid").val(id);
       $('#revokeModal').modal('show');
  }
  </script>
  <script type="text/javascript">
    $(".custom-select").each(function() {
  var classes = $(this).attr("class"),
      id      = $(this).attr("id"),
      name    = $(this).attr("name");
  var template =  '<div class="' + classes + '">';
      template += '<span class="custom-select-trigger">' + $(this).attr("placeholder") + '</span>';
      template += '<div class="custom-options">';
      $(this).find("option").each(function() {
        template += '<span class="custom-option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + '</span>';
      });
  template += '</div></div>';
  
  $(this).wrap('<div class="custom-select-wrapper"></div>');
  $(this).hide();
  $(this).after(template);
});
$(".custom-option:first-of-type").hover(function() {
  $(this).parents(".custom-options").addClass("option-hover");
}, function() {
  $(this).parents(".custom-options").removeClass("option-hover");
});
$(".custom-select-trigger").on("click", function() {
  $('html').one('click',function() {
    $(".custom-select").removeClass("opened");
  });
  $(this).parents(".custom-select").toggleClass("opened");
  event.stopPropagation();
});
$(".custom-option").on("click", function() {
  $(this).parents(".custom-select-wrapper").find("select").val($(this).data("value"));
  $(this).parents(".custom-options").find(".custom-option").removeClass("selection");
  $(this).addClass("selection");
  $(this).parents(".custom-select").removeClass("opened");
  $(this).parents(".custom-select").find(".custom-select-trigger").text($(this).text());
});


<div class="col-md-6 padboth">
<div class="form-group">
<label><img src="live.png" style="width:18px;margin-right:4px;">Live</label>
 <div><input type="text" class="form-control datepicker" name=""></div>
  </div>
  </div>
  </script>
@endsection