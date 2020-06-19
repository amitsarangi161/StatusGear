@extends('layouts.app')

@section('content')

@if(Session::has('message'))
   <p class="alert alert-info text-center">{{ Session::get('message') }}</p>
@endif
<form action="/saveclient" method="post">
	{{csrf_field()}}
<table class="table table-responsive table-hover table-bordered table-striped" >
        <tr>
            <td colspan="4" class="text-center bg-navy">ADD A NEW CLIENT</td>
        </tr>
        <tr>
         <td><strong>CLIENT NAME</strong><span style="color: red"> *</span></td>
         <td><input type="text" name="clientname" class="form-control" placeholder="Enter Client Name" required=""></td>
         <td><strong>OFC/ORG NAME</strong><span style="color: red"> *</span></td>
         <td><input type="text" name="orgname" class="form-control" placeholder="Enter Organisation Name" required=""></td>
        </tr>
        <tr>
        	<td><strong>CONTACT NO</strong><span style="color: red"> *</span></td>
           <td><input type="number" name="contact1" class="form-control" placeholder="Enter Contact No"></td>
           <td><strong>ALTERNATIVE CONTACT NO</strong></td>
           <td><input type="number" name="contact2" class="form-control" placeholder="Enter Alternative Contact No"></td>
        </tr>
        <tr>
        	<td><strong>OFICE CONTACT NO</strong></td>
           <td><input type="number" name="officecontact" class="form-control" placeholder="Enter Office  Contact No"></td>
        
           	<td><strong>EMAIL</strong></td>
           	<td><input type="email" name="email" class="form-control" placeholder="Enter Email Here"></td>
          
        </tr>

             <tr>
            <td><strong>GSTN</strong></td>
           <td><input type="text" name="gstn" class="form-control" placeholder="Enter Client GST No"></td>
        
            <td><strong>PAN NO</strong></td>
            <td><input type="text" name="panno" class="form-control" placeholder="Enter Client PAN No"></td>
          
        </tr>
        <tr>
        	<td><strong>RESIDENT ADDRESS</strong></td>
        	<td><textarea name="residentaddress" class="form-control" placeholder="Enter Resident address"></textarea></td>

        	<td><strong>OFFICE ADDRESS</strong><span style="color: red"> *</span></td>
        	<td><textarea name="officeaddress" class="form-control" placeholder="Enter Office address" required=""></textarea></td>
        </tr>
        <tr>
        	<td><strong>CITY</strong><span style="color: red"> *</span></td>
         <td><input type="text" name="city" class="form-control" placeholder="Enter city Here" required=""></td>
         <td><strong>DISTICT</strong><span style="color: red"> *</span></td>
         <td><input type="text" name="dist" class="form-control" placeholder="Enter Distict Here" required=""></td>
        </tr>
        <tr>
        	<td><strong>STATE</strong><span style="color: red"> *</span></td>
         <td><input type="text" name="state" class="form-control" placeholder="Enter state Here" required=""></td>
         <td><strong>COUNTRY</strong><span style="color: red"> *</span></td>
         <td><input type="text" name="country" class="form-control" placeholder="Enter Country Here" required=""></td>
        </tr>
        <tr>
        	<td><strong>ADDITIONAL INFO</strong><span style="color: red"> *</span></td>
        	<td><textarea name="additionalinfo" class="form-control" placeholder="Enter Addional Info"></textarea></td>
        </tr>

                <tr>
            <td></td>
             <td colspan="4"><input type="submit" value="Submit" class="btn btn-success" style="float: right ;"></td>
</tr>
</table>

</form>
<table>
    
</table>

@if($clients)
<div class="box">
<div class="box-body">
    <div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped datatable" width="100%">
    <thead>
        <tr class="bg-navy" style="font-size: 10px;">
            <th>ID</th>
            <th>CLIENT NAME</th>
            <th>ORG NAME</th>
            <th>CONTACT</th>
            <th>OFFICE CONTACT</th>
            <th>EMAIL</th>
            <th>OFC ADD</th>
            <th>CITY</th>
            <th>STATE</th>
            <th>COUNTRY</th>
            <th>GST NO</th>
            <th>PAN NO</th>
            <th>EDIT</th>
           <!--  <th>DELETE</th> -->
        </tr>
    </thead>
    <tbody>
        @foreach($clients as $client)
        <tr style="font-size: 12px;">
            <td>{{$client->id}}</td>
            <td>{{$client->clientname}}</td>
            <td>{{$client->orgname}}</td>
            <td>{{$client->contact1}}</td>
            <td>{{$client->officecontact}}</td>
            <td>{{$client->email}}</td>
            <td>{{$client->officeaddress}}</td>
            <td>{{$client->city}}</td>
            <td>{{$client->state}}</td>
            <td>{{$client->country}}</td>
            <td>{{$client->gstn}}</td>
            <td>{{$client->panno}}</td>
           
            <td><a href="/editclient/{{$client->id}}" class="btn btn-primary">EDIT</a></td>

   <!--          <td>
                <form action="/deleteclient/{{$client->id}}" method="post">
                     {{method_field('DELETE')}}
                     {{csrf_field()}}
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do You Want Delete this Client');">DELETE</button>
                    
                </form>
            </td> -->

        </tr>

        @endforeach
    </tbody>
</table>
</div>
</div>
</div>
@endif

@endsection