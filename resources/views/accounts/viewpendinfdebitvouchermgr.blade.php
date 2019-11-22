@extends('layouts.account')

@section('content')
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">VIEW PENDING DEBIT VOUCHER(APPROVAL BY MANAGER)</td>
		
	</tr>
	
</table>

<div class="well">
	<table class="table">
		<tr>
			<td width="10%"><strong>ID :</strong></td>
			<td width="40%">#{{$debitvoucherheader->id}}</td>
			<td width="10%"><strong>VENDOR :</strong></td>
			<td width="40%"><button type="button" class="btn btn-success" onclick="openvendordetails('{{$vendor->vendorid}}','{{$vendor->vendorname}}','{{$vendor->mobile}}','{{$vendor->bankname}}','{{$vendor->acno}}','{{$vendor->branchname}}','{{$vendor->ifsccode}}','{{trim(preg_replace('/\s+/', ' ',$vendor->details))}}','{{$vendor->photo}}','{{$vendor->vendoridproof}}')">{{$debitvoucherheader->vendorname}}</button></td>
		</tr>
		<tr>
			<td width="10%"><strong>BILL DATE :</strong></td>
			<td width="40%">{{$debitvoucherheader->billdate}}</td>
			<td width="10%"><strong>BILL NO :</strong></td>
			<td width="40%">{{$debitvoucherheader->billno}}</td>
		</tr>
		<tr>
			<td width="10%"><strong>CREATED AT  :</strong></td>
			<td width="40%">{{$debitvoucherheader->created_at}}</td>
			<td width="10%"><strong>STATUS :</strong></td>
			<td width="40%"><span class="label label-warning">{{$debitvoucherheader->status}}</span></td>
		</tr>

		
	</table>
	
</div>
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-blue">
		<td class="text-center">ITEM LIST</td>
	</tr>
	
</table>
<table class="table table-responsive table-hover table-bordered table-striped">
	<thead>
			<tr class="bg-navy">
    	    <td>Item Name</td>
			<td>Units</td>
			<td>Qty</td>
			<td>MRP</td>
			<td>Discount</td>
			<td>Price</td>
			<td>CGST Rate</td>
			<td>CGST Cost</td>
			<td>SGST Rate</td>
			<td>SGST Cost</td>
			<td>IGST Rate</td>
			<td>IGST Cost</td>
			<td>AMOUNT</td>
    		
           </tr>

	</thead>
	<tbody>
		@foreach($debitvouchers as $debitvoucher)
		<tr>
			<td>{{$debitvoucher->itemname}}</td>
			<td>{{$debitvoucher->unitname}}</td>
			<td>{{$debitvoucher->qty}}</td>
			<td>{{$debitvoucher->mrp}}</td>
			<td>{{$debitvoucher->discount}}</td>
			<td>{{$debitvoucher->price}}</td>
			<td>{{$debitvoucher->sgstrate}}</td>
			<td>{{$debitvoucher->sgstcost}}</td>
			<td>{{$debitvoucher->cgstrate}}</td>
			<td>{{$debitvoucher->cgstcost}}</td>
			<td>{{$debitvoucher->igstrate}}</td>
			<td>{{$debitvoucher->igstcost}}</td>
			<td>{{$debitvoucher->grossamt}}</td>
		</tr>
		@endforeach
		
	</tbody>
</table>
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-blue">
		<td class="text-center">PAYMENT DETAILS</td>
	</tr>
	
</table>
<form action="/approvedebitvouchermgr/{{$debitvoucherheader->id}}" method="post">

	{{csrf_field()}}
<table class="table">
	    	<tr>
	    		<td width="50%"><strong>Total MRP</strong></td>
	    		<td width="50%"><input type="text" id="tmrp" value="{{$debitvoucherheader->tmrp}}" name="tmrp" id="tmrp" class="form-control" readonly="" required=""></td>
	    	</tr>
	    	<tr>
	    		<td width="50%"><strong>Total Discount</strong></td>
	    		<td width="50%"><input type="text" value="{{$debitvoucherheader->tdiscount}}" class="form-control" id="tdiscount" name="tdiscount" readonly=""></td>
	    	</tr>
	    	<tr>
	    		<td width="50%"><strong>Total Price</strong></td>
	    		<td width="50%"><input type="text" value="{{$debitvoucherheader->tprice}}" class="form-control" id="tprice" name="tprice" readonly="" required=""></td>
	    	</tr>
	    	<tr>
	    		<td width="50%"><strong>Total Quantity</strong></td>
	    		<td width="50%"><input type="text" value="{{$debitvoucherheader->tqty}}" class="form-control" id="tqty" name="tqty" readonly="" required=""></td>
	    	</tr>

	    	<tr>
	    		<td width="50%"><strong>Total SGST</strong></td>
	    		<td width="50%"><input type="text" value="{{$debitvoucherheader->tsgst}}" class="form-control" id="tsgst" name="tsgst" readonly=""></td>
	    	</tr>
	    	<tr>
	    		<td width="50%"><strong>Total CGST</strong></td>
	    		<td width="50%"><input type="text" value="{{$debitvoucherheader->tcgst}}" class="form-control" id="tcgst" name="tcgst" readonly=""></td>
	    	</tr>


	    		<tr>
	    		<td width="50%"><strong>Total IGST</strong></td>
	    		<td width="50%"><input type="text" value="{{$debitvoucherheader->tigst}}" class="form-control" id="tigst" name="tigst" readonly=""></td>
	    	   </tr>

	    	<tr>
	    		<td width="50%"><strong>Total Amount</strong></td>
	    		<td width="50%"><input type="text" value="{{$debitvoucherheader->totalamt}}" class="form-control" id="totalamt" name="totalamt" readonly="" required=""></td>
	    	 </tr>

	    	
	    	 <tr>
	    	 	<td width="50%"><strong>Attach a invoice copy</strong></td>
	    	 	<td>
           <a href="{{asset('img/debitvoucher/'.$debitvoucherheader->invoicecopy)}}" target="_blank">
          		<img style="height:200px;width:200px;" src="{{asset('img/debitvoucher/'.$debitvoucherheader->invoicecopy)}}" alt="noimage" id="imgshow">
          	</a>
          	  <a href="{{asset('img/debitvoucher/'.$debitvoucherheader->invoicecopy)}}" class="btn btn-primary btn-sm" download>
               <span class="glyphicon glyphicon-download-alt"></span> Download
               </a>
               </td>
	    	 </tr>
	    	<tr>
	    		<td width="50%"><strong>IT Deduction(in %)</strong></td>
	    		<td width="50%"><input type="text" class="form-control dedcalc" id="itdeduction" name="itdeduction" autocomplete="off"  value="0"></td>

	    	 </tr>
	    	  <tr>
	    		<td width="50%"><strong>Other Deduction(in %)</strong></td>
	    		<td width="50%"><input type="text" class="form-control dedcalc" id="otherdeduction" autocomplete="off" name="otherdeduction" value="0"></td>
	    		
	    	 </tr>
	    	  <tr>
	    		<td width="50%"><strong>Final Price</strong></td>
	    		<td width="50%"><input type="text" class="form-control" value="{{$debitvoucherheader->totalamt}}" id="finalamount" name="finalamount" readonly="" required=""></td> 
	    		
	    	  </tr>
	    	    <tr>
	    		<td width="50%"><strong>Approval Amount</strong></td>
	    		<td width="50%"><input type="text" class="form-control" value="{{$debitvoucherheader->totalamt}}" id="approvalamount" name="approvalamount" required=""></td> 
	    		
	    	  </tr>
	</table>
	
<table class="table table-responsive">
	<tr>
		<p class="alert alert-danger" style="text-align: center;font-weight: bold;font-size: 20px;" hidden="" id="errormsg"></p>
		<td ><button type="submit" id="submitbtn" class="btn btn-success pull-right btn-lg" onclick="return confirm('Do You Want to Proceed?')">APPROVE</button></td>
	</tr>
</table>
</form>

<div id="vendormodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center"><strong>VENDOR DETAILS</strong></h4>
      </div>
      <div class="modal-body">
        <table class="table">
          <tr>
            <td><strong>VENDOR ID#</strong></td>
            <td><strong id="vendorid1"></strong></td>
            <td><strong>VENDOR NAME</strong></td>
            <td><strong id="vendorname1"></strong></td>
          </tr>
          <tr>
            <td><strong>VENDOR MOBILE</strong></td>
            <td><strong id="vendormobile1"></strong></td>
            <td><strong>BANK NAME</strong></td>
            <td><strong id="bankname1"></strong></td>
          </tr>
          <tr>
            <td><strong>AC NO</strong></td>
            <td><strong id="acno1"></strong></td>
            <td><strong>BRANCH NAME</strong></td>
            <td><strong id="branchname1"></strong></td>
          </tr>
          <tr>
            <td><strong>IFSC CODE</strong></td>
            <td><strong id="ifsccode1"></strong></td>
            <td><strong>DETAILS</strong></td>
            <td><strong id="details1"></strong></td>
            
          </tr>
          <tr>
            <td><strong>PHOTO</strong></td>
            <td id="photo1"></td>
            <td><strong>ID PROOF</strong></td>
            <td id="idproof1"></td>
          </tr>
          
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
	$( "#approvalamount" ).on("change paste keyup", function() {
            var finalamount=parseFloat($("#finalamount").val());
            var approvalamount=parseFloat($("#approvalamount").val());
            if (approvalamount > finalamount+1) {
             $('#submitbtn').prop('disabled', true);
             $("#errormsg").show();
             $("#errormsg").text('approval amount cant be greater than the final amount !' );
            }
            else
            { 
            	$("#errormsg").hide();
            	$("#errormsg").text('');
            	$('#submitbtn').prop('disabled', false);
            }
	});

	$( ".dedcalc" ).on("change paste keyup", function() {

        var itdeduction=$("#itdeduction").val();
        if(itdeduction=='') {
           gitdeduction = 0;

          }
          else
          {
            gitdeduction=itdeduction;
          }

         var otherdeduction=$("#otherdeduction").val();
          if(otherdeduction=='') {
           gotherdeduction = 0;

          }
          else
          {
            gotherdeduction=otherdeduction;
          }
          var subtot=$("#tmrp").val();
          var totalamt=$("#totalamt").val();

          var itdedamt=parseFloat(subtot)*(parseFloat(gitdeduction/100));
          var otheramt=parseFloat(subtot)*(parseFloat(gotherdeduction/100));

          var final=Number.parseFloat(parseFloat(totalamt)-(parseFloat(itdedamt)+parseFloat(otheramt))).toFixed(2);

          $("#finalamount").val(final);


          

	});
	function openvendordetails(vendorid,vendorname,mobile,bankname,acno,branchname,ifsccode,details,photo,vendoridproof)
   {

        

             $("#vendorid1").html(vendorid);
             $("#vendorname1").html(vendorname);
             $("#vendormobile1").html(mobile);
             $("#bankname1").html(bankname);
             $("#acno1").html(acno);

             $("#branchname1").html(branchname);
             $("#ifsccode1").html(ifsccode);
             $("#details1").html(details);
             $("#photo1").html('<a href="/img/vendor/'+photo+'" target="_blank"><img src="/img/vendor/'+photo+'" style="height:70px;width:95px;" alt="click to view"></a>');

             $("#idproof1").html('<a href="/img/vendor/'+vendoridproof+'" target="_blank"><img src="/img/vendor/'+vendoridproof+'" style="height:70px;width:95px;" alt="click to view"></a>');

             $("#vendormodal").modal('show');
   }
</script>


@endsection