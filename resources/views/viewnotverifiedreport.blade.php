@extends('layouts.app')
@section('content')
<table class="table table-responsive table-hover table-bordered table-striped">
<tr class="bg-navy">
	<td class="text-center">REPORT DETAILS</td>
</tr>

</table>

<table class="table table-responsive table-hover table-bordered table-striped">
<tr>
   <td><strong>REPORT DATE</strong></td>
   <td>{{$projectreports->reportfordate}}</td>
   <td><strong>CREATED ON</strong></td>
   <td>{{$projectreports->created_at}}</td>
</tr>
<tr>
   <td><strong>REPORT OF</strong></td>
   <td>{{$projectreports->name}}</td>
   <td><strong>FOR CLIENT</strong></td>
   <td>{{$projectreports->orgname}}</td>
</tr>
<tr>
   <td><strong>PROJECT NAME</strong></td>
   <td>{{$projectreports->projectname}}</td>
   <td><strong>ACTIVITY NAME</strong></td>
   <td>{{$projectreports->activityname}}</td>
</tr>
<tr>
   <td><strong>SUBJECT</strong></td>
   <td>{{$projectreports->subject}}</td>
   <td><strong>DESCRIPTION</strong></td>
   <td>{!!$projectreports->description!!}</td>
</tr>

<tr>
   <td><strong>WRITTEN BY</strong></td>
   <td>{{$projectreports->author}}</td>
   <td><strong>VERIFIED BY</strong></td>
   <td>{{$projectreports->acceptedby}}</td>
</tr>
<tr>
	<td><strong>STATUS</strong></td>
	 @if($projectreports->status=="VERIFIED")
           <td><span class="label label-success">{{$projectreports->status}}</span></td>
            @else
            <td><span class="label label-danger">{{$projectreports->status}}</span></td>
      
            @endif

   @if($projectreports->status!="VERIFIED")
   <td>CLICK HERE </td>
   <td>
    
      <button class="btn btn-success" onclick="openverifymodal();">VERIFY</button>
    
   </td>  

      @endif

  
</tr>
</table>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">REPORT VERIFY</h4>
      </div>
      <div class="modal-body">
         <form action="/adminverifyreport/{{$projectreports->id}}" method="post">
            {{csrf_field()}}
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
   
   function openverifymodal() {
       $("#myModal").modal('show');
   }
</script>
@endsection