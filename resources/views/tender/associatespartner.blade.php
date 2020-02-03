@extends('layouts.tender')
@section('content')

<table class="table table-responsive table-hover table-bordered table-striped" >
        <tr>
            <td colspan="4" class="text-center bg-navy">ADD A NEW ASSCOIATES</td>
        </tr>
        <tr>
         <td><strong>ASSOCIATE PARTNER NAME</strong><span style="color: red"> *</span></td>
         <td><input type="text" name="associatepartnername" class="form-control" placeholder="Enter Client Name" required=""></td>
         	<td><strong>OFFICE ADDRESS</strong><span style="color: red"> *</span></td>
        	<td><textarea name="officeaddress" class="form-control" placeholder="Enter Office address" required=""></textarea></td>
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
@endsection