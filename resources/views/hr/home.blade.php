@extends('layouts.hr')

@section('content')
<style type="text/css">
    .b {
    white-space: nowrap; 
    width: 120px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style>
   
<link href="{{ URL::asset('css/bootstrap-timepicker.css') }}" rel="stylesheet" type="text/css" />
<section class="content">



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
              <a  href="/hrviewallmytodo" class="btn btn-default pull-right"><i class="fa fa-bars"></i>Todo List</a>
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
  
    
    @if(count($complaints)>0  ||count($pendingcomplaints)>0)




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
      <td><a href="/uc/complainttoresolve" class="btn btn-primary">{{$compalint->id}}</a></td>
      <td>{{$compalint->type}}</td>
      <td>{{$compalint->from}}</td>
      <td>{{$compalint->to}}</td>
      <td>{{$compalint->ccname}}</td>
      <td>{{$compalint->created_at}}</td>
      <td><p class="b" title="{{$compalint->description}}">{{$compalint->description}}</p></td>

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
    <div class="table-responsive">
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
      <td><a href="/uc/complainttoresolve" class="btn btn-primary">{{$compalint->id}}</a></td>
      <td>{{$compalint->type}}</td>
      <td>{{$compalint->from}}</td>
      <td>{{$compalint->to}}</td>
      <td>{{$compalint->ccname}}</td>
      <td>{{$compalint->created_at}}</td>
      <td><p class="b" title="{{$compalint->description}}">{{$compalint->description}}</p></td>

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
      <form action="/savetodo" method="post">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ADD TODO</h4>
      </div>
      <div class="modal-body">
      
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
          
           
              
              
                     
          
        </table>
       
        
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-success btn-lg" type="submit">ADD</button>
      </div>
    </div>

  </div>
   </form>
</div>



<div id="myModal3" class="modal fade" role="dialog">
  <form action="/updatetodo" method="post">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">EDIT TODO</h4>
      </div>
      <div class="modal-body">
        
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
         
            
                            
           
          
        </table>
        </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-success btn-lg" type="submit">UPDATE</button>

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

   </script>

    
    
@endsection

