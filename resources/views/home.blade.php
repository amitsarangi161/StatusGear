<!--   @if(Auth::user()->usertype=='USER')

<script type="text/javascript">
if ((navigator.userAgent.indexOf('iPhone') != -1) ||
        (navigator.userAgent.indexOf('iPod') != -1) ||
        (screen.width <= 699)) {
        window.location = "/mobile"; 
        }
        else { 
      
        }
</script>


@endif -->

@extends('layouts.app')

@section('content')
   
<link href="{{ URL::asset('css/bootstrap-timepicker.css') }}" rel="stylesheet" type="text/css" />
<section class="content">

@if(Auth::user()->usertype=='MASTER ADMIN')
      <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$noofclients}}</h3>

              <p>No Of Clients</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="/dm/viewallclient" class="small-box-footer">view all clients<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
            <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$noofprojects}}</h3>

              <p>No Of Projects</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="/projects/viewallproject" class="small-box-footer">view all projects<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
       
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$completedprojects}}<sup style="font-size: 20px"></sup></h3>

              <p>Completed Project</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/projects/viewallproject" class="small-box-footer">view all projects<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$noofusers}}</h3>

              <p>No Of Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="/dm/adduser" class="small-box-footer">view all users <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
   
        
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="/usermsg/mymessages">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Messages</span>
              <span class="info-box-number" id="countmsg111"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="/uc/viewallcomplaints" title="Differ Date Request">
          <div class="info-box">
            
             <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text" title="Differ Date Request">Differ Date Request</span>
              @php
                 $countdifferdate=\App\complaint::where('status','REQ DIFFER DATE')
                                 ->count();

              @endphp
              <span class="info-box-number" id="differcount">{{$countdifferdate}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="/viewrequisitions/pendingrequisitions" title="Pending Requisition">

          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" title="Pending Requisition">Pending Requisition</span>
              <span class="info-box-number">{{$pendingrequistioncount}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="/expense/pendingexpenseentry" title="Pending Expense Entry">
                    <div class="info-box">
           
            <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Pending Expense Entry</span>
              <span class="info-box-number">{{$pendingexpenseentrycount}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>

      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="/vouchers/pendingdebitvoucheradmin" title="PENDING DEBIT VOUCHER ADMIN">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i class="fa fa-bookmark-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PENDING DR VOUCHER</span>
              <span class="info-box-number">{{$countpendingdrvoucher}}</span>

             
                  <span class="progress-description">
                   
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="/tour/pendingtourapplications" target="_blank" title="PENDING TOUR APPROVAL">
          <div class="info-box">
            <span class="info-box-icon"><i class="fa fa-plane"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PENDING TOUR APPROVAL</span>
              <span class="info-box-number">{{$tours}}</span>

                
            </div>
       
          </div>
          </a>
        </div>
        <!--  
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Events</span>
              <span class="info-box-number">41,410</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
            </div>
           
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Comments</span>
              <span class="info-box-number">41,410</span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
            </div>
      
          </div>
   
        </div> -->
   
      </div>

      @endif

      <div class="row">
            <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

         <h3 class="box-title" style="font-size;font-size: 20px;color: darkred;font-weight: bolder;">My Todo List For Today</h3>
              <div class="text-center">
                    <button type="button" onclick="openmytodo();" class="btn btn-default text-center"><i class="fa fa-plus"></i> Add item</button>
              </div>
              <div class="box-tools pull-right">
               
                 {{$todos->links()}}
               
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list">
                @foreach($todos as $todo)

                @php
                    if($todo->status=='1')
                    {
                       $color1="aqua";
                    }
                    else
                    {
                         $color1="#f6afd6";
                    }
                @endphp
             
                                <li style="background-color: {{$color1}}">
                  <!-- drag handle -->
                  <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <!-- checkbox -->
                  <input type="checkbox" name="check" id="check{{$todo->id}}"  value="{{$todo->id}}" onclick='handleClick(this.value);' {{ $todo->status=='0' ? 'checked' : '' }}>
                  <!-- todo text -->
                  <span class="text">{{$todo->description}}</span>
                  <!-- Emphasis label -->
                
                  <small class="label label-info"><i class="fa fa-clock-o"></i> {{$todo->date}}</small>
                  <small class="label label-warning"><i class="fa fa-clock-o"></i>{{date("g:i a", strtotime($todo->time))}}</small>
                   @php
                     if($todo->status=='1')
                     {
                         $status1="Pending";
                     }
                     else
                     {
                          $status1="Complted";
                     }
                   @endphp
                   @if($todo->status=='1')
                   <small class="label label-success"><i class="fa fa-clock-o"></i>{{$status1}}</small>
                   @else
                    <small class="label label-danger"><i class="fa fa-clock-o"></i>{{$status1}}</small>
                   @endif
                  
                  <!-- General tools such as edit or delete-->
                  <div class="tools">
                    <i class="fa fa-edit" onclick="openeditmodal('{{$todo->id}}','{{$todo->description}}','{{$todo->date}}','{{date("g:i A", strtotime($todo->time))}}');"></i>
                    <a href="/deletemytodo/{{$todo->id}}" onclick="return confirm('Do You want to delete this todo?');"><i class="fa fa-trash-o"></i></a>
                  </div>
                </li>
                @endforeach
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <a  href="/userviewallmytodo" class="btn btn-default pull-right"><i class="fa fa-bars"></i>Todo List</a>
            </div>
          </div>
           </div>
          <!-- <div class="col-md-6">
           <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Orders</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
         
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Item</th>
                    <th>Status</th>
                    <th>Popularity</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                    <td>Call of Duty IV</td>
                    <td><span class="label label-success">Shipped</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR1848</a></td>
                    <td>Samsung Smart TV</td>
                    <td><span class="label label-warning">Pending</span></td>
                    <td>
                      <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                    <td>iPhone 6 Plus</td>
                    <td><span class="label label-danger">Delivered</span></td>
                    <td>
                      <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                    <td>Samsung Smart TV</td>
                    <td><span class="label label-info">Processing</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR1848</a></td>
                    <td>Samsung Smart TV</td>
                    <td><span class="label label-warning">Pending</span></td>
                    <td>
                      <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                    <td>iPhone 6 Plus</td>
                    <td><span class="label label-danger">Delivered</span></td>
                    <td>
                      <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                    <td>Call of Duty IV</td>
                    <td><span class="label label-success">Shipped</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            
            </div>
          
            <div class="box-footer clearfix">
              <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
            </div>
       
          </div> -->
    </div>
    
  

    </section>







    <!-- TO DO ACTIVITY MODALS -->


    @if(Auth::user()->usertype!='MASTER ADMIN')




    @php
     
     $tdate=date('Y-m-d');
     $uid=Auth::id();
     $complaints=\App\complaint::select('complaints.*','u1.name as to','u2.name as from','u3.name as ccname')
                 ->leftJoin('users as u1','complaints.touserid','=','u1.id')
                 ->leftJoin('users as u2','complaints.fromuserid','=','u2.id')
                 ->leftJoin('users as u3','complaints.cc','=','u3.id')
                  ->where('complaints.lastdate',$tdate)
                  ->where('complaints.status','!=','RESOLVED')

                 ->where(function($query) use ($uid){
                      $query->where('complaints.touserid',$uid);
                      $query->orWhere('complaints.cc',$uid);
                  })
                
                 ->orderBy('complaints.updated_at','DESC')
                 ->get();


      
    
       $from=new \Carbon\Carbon(date('Y-m-d'));
       $fromdate =new \Carbon\Carbon(date('Y-m-d'));


       $tilldate = $fromdate->addDays(7);
   
     $allprojects = \App\project::whereBetween('enddate', [$from,$tilldate] )
                              ->where('status','!=','COMPLETED')
                              ->get();



      $pendingcomplaints=\App\complaint::select('complaints.*','u1.name as to','u2.name as from','u3.name as ccname')
                 ->leftJoin('users as u1','complaints.touserid','=','u1.id')
                 ->leftJoin('users as u2','complaints.fromuserid','=','u2.id')
                 ->leftJoin('users as u3','complaints.cc','=','u3.id')
                  ->where('complaints.lastdate','<',$tdate)
                  ->where('complaints.status','!=','RESOLVED')

                 ->where(function($query) use ($uid){
                      $query->where('complaints.touserid',$uid);
                      $query->orWhere('complaints.cc',$uid);
                  })
                
                 ->orderBy('complaints.updated_at','DESC')
                 ->get();


     @endphp
  
    
    @if(count($complaints)>0 ||count($pendingcomplaints)>0)




<div class="modal fade" id="myModal9" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="background-color: chocolate;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center;">Today Activity Reminder</h4>
        </div>
        <div class="modal-body">

     @if(count($complaints)>0 )   
     <div class="table-responsive">  
          <table class="table table-responsive table-condensed table-hover table-bordered table-striped">
            <tr class="bg-blue"><td class="text-center">COMPLAINTS TO RESOLVE TODAY</td></tr>
          </table>
          <table class="table table-responsive table-condensed table-hover table-bordered table-striped">
              <thead>
               <tr class="bg-navy" style="font-size: 10px;">
      <td>ID</td>
      <td>TYPE</td>
      <td>COMPLAINT FORM</td>
      <td>COMPLAINT TO</td>
      <td>CC</td>
      <td>DATE OF POST</td>
      <td>DESCRIPTION</td>
  
      <td>EXP.DATE TO SOLVE</td>
      <td>REMARK</td>
   
      <td>STATUS</td>
      <td>VIEW</td>
      
     
    </tr>
    </thead>
           <tbody>
             @foreach($complaints as $compalint)
    <tr style="font-size: 13px;">
      <td>{{$compalint->id}}</td>
      <td>{{$compalint->type}}</td>
      <td>{{$compalint->from}}</td>
      <td>{{$compalint->to}}</td>
      <td>{{$compalint->ccname}}</td>
      <td>{{$compalint->created_at}}</td>
      <td>{{$compalint->description}}</td>

      <td>{{$compalint->lastdate}}</td>
      <td>{{$compalint->remark}}</td>

      @if($compalint->status=='PENDING')
      <td><span class="label label-danger">{{$compalint->status}}</span></td>
      @else
      <td><span class="label label-success">{{$compalint->status}}</span></td>
      @endif
      <td>
        <a href="/uc/complainttoresolve" class="btn btn-primary">VIEW</a>
      </td>
    
    </tr>
    @endforeach
             
           </tbody>
    </table>
  </div>
    @endif

    @if(count($pendingcomplaints)>0)
    <div class="table-responsive">
     <table class="table table-responsive table-condensed table-hover table-bordered table-striped">
            <tr class="bg-blue"><td class="text-center">YOU HAVE PENDING COMPLAINTS PLEASE TAKE ACTION</td></tr>
    </table>
          <table class="table table-responsive table-condensed table-hover table-bordered table-striped">
              <thead>
               <tr class="bg-navy" style="font-size: 10px;">
      <td>ID</td>
      <td>TYPE</td>
      <td>COMPLAINT FORM</td>
      <td>COMPLAINT TO</td>
      <td>CC</td>
      <td>DATE OF POST</td>
      <td>DESCRIPTION</td>
  
      <td>EXP.DATE TO SOLVE</td>
      <td>REMARK</td>
   
      <td>STATUS</td>
      <td>VIEW</td>
      
     
    </tr>
    </thead>
           <tbody>
             @foreach($pendingcomplaints as $compalint)
    <tr style="font-size: 13px;">
      <td>{{$compalint->id}}</td>
      <td>{{$compalint->type}}</td>
      <td>{{$compalint->from}}</td>
      <td>{{$compalint->to}}</td>
      <td>{{$compalint->ccname}}</td>
      <td>{{$compalint->created_at}}</td>
      <td>{{$compalint->description}}</td>

      <td>{{$compalint->lastdate}}</td>
      <td>{{$compalint->remark}}</td>

      @if($compalint->status=='PENDING')
      <td><span class="label label-danger">{{$compalint->status}}</span></td>
      @else
      <td><span class="label label-success">{{$compalint->status}}</span></td>
      @endif
      <td>
        <a href="/uc/complainttoresolve" class="btn btn-primary">VIEW</a>
      </td>
    
    </tr>
    @endforeach
             
           </tbody>
    </table>
  </div>

    @endif

    @if(count($allprojects)>0)
        @if(Auth::user()->usertype=='ADMIN')
      <table class="table table-responsive table-condensed table-hover table-bordered table-striped">
            <tr class="bg-blue"><td class="text-center">PRJECTS FINISHED WITHIN 7days</td></tr>
      </table>
<div class="table-responsive">
      <table class="table table-responsive table-condensed table-hover table-bordered table-striped">
        <thead>
          <tr class="bg-navy">
            <th>PROJECT ID</th>
            <th>PROJECT NAME</th>
            <th>CLIENT NAME</th>
            <th>DATE OF COMMENCEMENT</th>
            <th>END DATE</th>
            <th>PRIORITY</th>
            <th>STATUS</th>
            <th>DAY REMAIN</th>
            <th>VIEW</th>
            
          </tr>
        </thead>
        <tbody>
            @foreach($allprojects as $allproject)

                @php

                  $date = Carbon\Carbon::parse($allproject->enddate. '11:59:59');
               $now = Carbon\Carbon::now();

               $diff = $date->diffInDays($now);
               if($allproject->status=='COMPLETED')
               {
                   $txtcolor='label bg-green';
                $rowcolor='#0cd50c';
               }
               elseif($diff<=5 && $allproject->status!='COMPLETED')
               {
                $txtcolor='label bg-red';
                $rowcolor='#f9191999';
               }
               else
               {
                  $txtcolor='label bg-blue';
                  $rowcolor='#fff';
               }

                @endphp

               <tr>
                 <td>{{$allproject->id}}</td>
                 <td>{{$allproject->projectname}}</td>
                 <td>{{$allproject->clientname}}</td>
                 <td>{{$allproject->startdate}}</td>
                 <td>{{$allproject->enddate}}</td>
                 <td>{{$allproject->priority}}</td>
                 <td>{{$allproject->status}}</td>
                 <td><small class="{{$txtcolor}}">{{$diff}}</small></td>
                 <td>
                  @if(Auth::user()->usertype=='USER')
                  <a href="/userprojects/showuserprojectdetails/{{$allproject->id}}" class="btn btn-primary">VIEW DETAILS</a>
                  @elseif(Auth::user()->usertype=='ADMIN')
                    <a href="/hod/adminprojectdetails/{{$allproject->id}}" class="btn btn-primary">VIEW DETAILS</a>
                  @endif
                </td>


               </tr>

            @endforeach
        </tbody>
      </table>
      </div>
    @endif
    @endif


        </div>
        <div class="modal-footer" style="background-color: chocolate;">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


 


    <script type="text/javascript">
      $(window).on('load',function(){
        $('#myModal9').modal('show');
    });
      $('#myModal9').modal({
    backdrop: 'static',
    keyboard: false
    });
    </script>


    @endif

    
     
    @endif

     <div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ADD TODO</h4>
      </div>
      <div class="modal-body">
        <form action="/savetodo" method="post">
          {{csrf_field()}}
        <table class="table">
          <tr>
            <td>Notes</td>
            <td><textarea class="form-control" name="description"></textarea></td>
          </tr>
          <tr>
            <td>Date</td>
            <td><input type="text" name="date" class="form-control datepicker1" readonly="">
              <p style="color: red;">*click for change the date</p>
            </td>
          </tr>
          <tr>
            <td>Time</td>
            <td><input type="text" name="time" class="form-control timepicker" readonly="">
              <p style="color: red;">*click for change the time</p>
            </td>
          </tr>
          <tr>
             <td colspan="2" style="text-align: right;">
              <button class="btn btn-success btn-lg" type="submit">ADD</button>
              
            </td>
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



<div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">EDIT TODO</h4>
      </div>
      <div class="modal-body">
        <form action="/updatetodo" method="post">
          {{csrf_field()}}
        <table class="table">
          <input type="hidden" id="tdid" name="tdid">
          <tr>
            <td>Notes</td>
            <td><textarea class="form-control" name="description" id="description"></textarea></td>
          </tr>
          <tr>
            <td>Date</td>
            <td><input type="text" name="date" id="date" class="form-control datepicker1" readonly="">
              <p style="color: red;">*click for change the date</p>
            </td>
          </tr>
          <tr>
            <td>Time</td>
            <td><input type="text" name="time" id="time" class="form-control timepicker" readonly="">
              <p style="color: red;">*click for change the time</p>
            </td>
          </tr>
          <tr>
             <td colspan="2" style="text-align: right;">
              <button class="btn btn-success btn-lg" type="submit">UPDATE</button>
              
            </td>
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

 

<script type="text/javascript" src="{{ URL::asset('js/bootstrap-timepicker.js') }}"></script>

   <script type="text/javascript">
     function openmytodo()
     {
        $("#myModal2").modal('show');
     }
     function openeditmodal(id,description,date,time)
     {
             $("#tdid").val(id);
             $("#description").val(description);
             $("#date").val(date);
             $("#time").val(time);

             $("#myModal3").modal('show');
     }
    $('.timepicker').timepicker({minuteStep: 1});


    function handleClick(value)
    {
        var chk=$('#check' + value).is(":checked")
         if(chk)
         {
            sta=0;
         }
         else
         {
          sta=1;
         }
         $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });
              

              $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxchangetodostatus")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      status: sta,
                      tid:value
                      

                     },

               success:function(data) { 
                
                location.reload();
               }
               });

    }


     $(document).ready(function(){
          
   countreqdiff();


     setInterval(function(){
     countreqdiff();
 }, 100000);

       });


       function countreqdiff()
       {
           $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

   //var u="business.draquaro.com/api.php?id=9658438020";

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxcountrequestdifferdate")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     
                     },

               success:function(data) { 
                     $("#differcount").html(data);
                     
                    
               }
             });
       }

   </script>

    
    
@endsection

