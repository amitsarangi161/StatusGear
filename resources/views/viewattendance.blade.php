@extends('layouts.app')

@section('content')

<table  class="table">
  <tr class="bg-blue">
    <td class="text-center">VIEW ATTENDANCE</td>
  </tr>
</table>
<table class="table">
  <tr>
    <td><strong>Select a Date</strong></td>
    <td><input type="text" name="date" id="date" class="form-control datepicker1"></td>
    <td><button type="button" class="btn btn-primary" onclick="showdetails()">SHOW</button></td>
  </tr>
  
</table>

<table class="table table-responsive table-hover table-bordered table-striped datatable6">
  <thead>
  <tr class="bg-navy">
    <th><strong>USER ID</strong></th>
    <th><strong>NAME</strong></th>
    <th><strong>STATUS</strong></th>
    <th><strong>VIEW</strong></th>
  </tr>
  </thead>
  <tbody id="empattendance">

    
  </tbody>

</table>
<script type="text/javascript">
  function showdetails()
  {
    var date=$("#date").val();
      if(date!='')
      {

         $.ajaxSetup({
    
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
            });
             

              $.ajax({
               type:'POST',
              
               url:'{{url("/showattendance")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      date: date
                      
                     },

               success:function(data) { 
                   
                 
 

   
                $("#empattendance").empty();
                   $.each(data,function(key,value){
                    if(value.present=='PRESENT')
                    {
                      var p='<span class="label label-success">'+value.present+'</span>';
                    }
                    else
                    {
                       var p='<span class="label label-danger">'+value.present+'</span>';
                    }
                    var x='<tr><td>'+value.uid+'</td><td>'+value.uname+'</td><td>'+p+'</td><td><button type="button" id="'+value.uid+'"  class="btn btn-info" onclick="viewuserlocation(this.id);">VIEW</button></td></tr>';
                    $("#empattendance").append(x);

                   });
                   

       $('.datatable6').DataTable({
        dom: 'Bfrtip',
        "order": [[ 0, "desc" ]],
        "iDisplayLength": 150,
         "bDestroy": true,
        buttons: [
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                footer:true,
                pageSize: 'A4',
                title: 'REPORT',            },
            {
                extend: 'excelHtml5',
                footer:true,
                title: 'REPORT'
            },
            {
                extend: 'print',
                
                footer:true,
                title: 'REPORT'
            }

       ],
            });
                          
               }
           });
          }
          else
          {
            alert("please select a date first");
          }
  }

  function viewuserlocation(uid)
  {
     var date=$("#date").val();
     window.open('/showuserlocation/'+uid+'/'+date, '_blank');
  }
</script>

@endsection