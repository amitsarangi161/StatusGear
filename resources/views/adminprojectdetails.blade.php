@extends('layouts.app')
@section('content')

 <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              

              <h3 class="profile-username text-center">Project Name:{{$project->projectname}}</h3>

              <p class="text-muted text-center">Client Name:{{$project->orgname}}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Project Id</b> <a class="pull-right">{{$project->projectid}}</a>
                </li>
                <li class="list-group-item">
                  <b>Start Date</b> <a class="pull-right">{{$project->startdate}}</a>
                </li>
                <li class="list-group-item">
                  <b>End Date</b> <a class="pull-right">{{$project->startdate}}</a>
                </li>
                 <li class="list-group-item">
                  <b>Priority</b> <a class="pull-right">{{$project->priority}}</a>
                </li>

                 <li class="list-group-item">
                  <b>Order Form</b> <a class="pull-right"><a href="/img/orderform/{{$project->orderform}}" download>
        Click Here to download
         </a></a>
                </li>
              
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>{{$project->status}}</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#all" data-toggle="tab">ALL</a></li>
              @foreach($activities as $key=>$activity)
           
                     <li><a href="#{{$activity->id}}" data-toggle="tab">{{$activity->activityname}}</a></li>
           
              @endforeach
             
            </ul>
            <div class="tab-content">


               @foreach($activities as $key=>$activity)
                  @php
                    $pid=$project->id;
                    $aid=$activity->acid;

                    $projectreports=\App\projectreport::select('projectreports.*','users.name')
                                  ->where('projectreports.projectid',$pid)
                                  ->where('projectreports.activityid',$aid)
                                   ->leftJoin('users','projectreports.userid','=','users.id')
                                  ->orderBy('projectreports.updated_at','DESC')
                                   ->get();
                    @endphp
                    
<div class="tab-pane" id="{{$activity->id}}">
                <!-- Post -->

                   


    @foreach($projectreports as $projectreport)
    <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
              <h5 class="text-center">{{$projectreport->name}} &nbsp !! &nbsp {{$activity->activityname}}</h5>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <h5 class="text-center">{{$projectreport->subject}}</h5>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
              <h6 class="text-center">{{$projectreport->reportfordate}} || <span>{{$projectreport->created_at}}</span></h6>
            </div>
          </div>
        </div>
        <div class="panel-body">
          <h5 class="text-justify">{!! $projectreport->description !!}</h5>
        </div>
        <div class="panel-footer">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <h5 class="text-center"><i class="fa fa-user"></i> Author ||<span>{{$projectreport->author}}</span></h5>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <h5 class="text-center"><span>Verified BY: {{$projectreport->acceptedby}}</span></h5>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              @if($projectreport->status=='VERIFIED')
              <div class="col-sm-6">
                <a href="/viewverifiedreport/{{$projectreport->id}}" class="btn btn-success" target="_blank">VERIFIED</a>
               <!--  <button type="button" class="btn btn-success">VERIFIED</button> -->
              </div>
              @else
              <div class="col-sm-6">
              <!--   <a href="/viewnotverifiedreport/{{$projectreport->id}}" class="btn btn-danger">NOT VERIFIED</a> -->
                <button type="button" class="btn btn-danger" onclick="openverifymodal('{{$projectreport->id}}');">NOT VERIFIED</button>
              </div>
              @endif
            </div>
          </div>
        </div>
  </div>
                
@endforeach


  </div>


 @endforeach

<!-- FOR ALL TAB -->
                    @php
                    $pid1=$project->id;
                   

                    $projectreports1=\App\projectreport::select('projectreports.*','users.name','activities.activityname')
                                  ->where('projectreports.projectid',$pid1)
                                   ->leftJoin('users','projectreports.userid','=','users.id')
                                    ->leftJoin('activities','projectreports.activityid','=','activities.id')
                                  ->orderBy('projectreports.updated_at','DESC')
                                   ->get();
                    @endphp


  <div class="active tab-pane" id="all">
     @foreach($projectreports1 as $projectreport)

    <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
              <h5 class="text-center">{{$projectreport->name}} !! {{$projectreport->activityname}}</h5>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <h5 class="text-center">{{$projectreport->subject}}</h5>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
              <h6 class="text-center">{{$projectreport->reportfordate}} || <span>{{$projectreport->created_at}}</span></h6>
            </div>
          </div>
        </div>
        <div class="panel-body">
          <h5 class="text-justify">{!! $projectreport->description !!}</h5>
        </div>
        <div class="panel-footer">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <h5 class="text-center"><i class="fa fa-user"></i> Author ||<span>{{$projectreport->author}}</span></h5>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <h5 class="text-center"><span>Verified BY: {{$projectreport->acceptedby}}</span></h5>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              @if($projectreport->status=='VERIFIED')
              <div class="col-sm-6">
                <a href="/viewverifiedreport/{{$projectreport->id}}" class="btn btn-success" target="_blank">VERIFIED</a>
               
              </div>
              @else
              <div class="col-sm-6">
            <!--     <a href="/viewnotverifiedreport/{{$projectreport->id}}" class="btn btn-danger">NOT VERIFIED</a> -->
                <button type="button" class="btn btn-danger" onclick="openverifymodal('{{$projectreport->id}}');">NOT VERIFIED</button>
              </div>
              @endif
            </div>
          </div>
        </div>
  </div>
                
@endforeach


  </div>




              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->



<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">REPORT VERIFY</h4>
      </div>
      <div class="modal-body">
         <form action="/adminverifyreport/1" method="post">
            {{csrf_field()}}
            <input type="hidden" name="reportid" id="reportid">
            <table class="table table-responsive table-hover table-bordered table-striped">
                 
         
         <tr>
            <td>REMARKS</td>
            <td>
            <textarea class="form-control" name="remarks"> </textarea>
               
           
         </td>
         </tr>
         <tr>
            <td><button type="submit" class="btn btn-success">CHANGE STATUS</button></td>
         </tr>
           
        </table>
         </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script type="text/javascript">
   
   function openverifymodal(id) {
       //alert(id);
       $("#reportid").val(id);
       $("#myModal").modal('show');
   }
</script>


@endsection