@extends('layouts.account')
@section('content')

@if(Session::has('msg'))
   <p class="alert alert-info text-center">{{ Session::get('msg') }}</p>
@endif

<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-navy">
		 <td class="text-center">DEBIT VOUCHER ENTRY</td>
	</tr>

</table>


<form action="/savedebitvouchers" method="post" enctype="multipart/form-data">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">
      <tr>
      	 <td style="width: 30%;">SELECT A VENDOR</td>
      	 <td>
      	 	<select class="form-control select2" name="vendorid" id="vendorid" required="">
      	 		<option value="">Select a vendor</option>
      	 		@foreach($vendors as $vendor)
               <option value="{{$vendor->id}}">{{$vendor->vendorname}}</option>

      	 		@endforeach
      	 		
      	 	</select>
      	 </td>
      </tr>
          <tr>
      	<td>BILL DATE</td>
      	<td>
      		<input type="text" class="form-control datepicker3" placeholder="Enter bill date" name="billdate" readonly="" required="">
      	</td>
      </tr>
      <tr>
      	 <td>BILL NO</td>
      	 <td><input type="text" name="billno" class="form-control calc" required="" placeholder="Enter Bill No Here" autocomplete="off" onkeyup="checkbill(this.value)" required="">
          <p  class="label label-danger">If Bill No not available then Enter "NA"</p>
         </td>
      	
      </tr>
  

      
      

	</table>
	<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-navy">
		 <td class="text-center">DEBIT VOUCHER ITEM ENTRY</td>
		
	</tr>
    </table>

    <table class="table">
	<tr>
		<td><strong>Item Name</strong></td>
		<td><input type="text" placeholder="Enter Item Name" class="form-control calc" id="itemname" autocomplete="off"></td>
		<td><strong>Units</strong></td>
		<td>
			<select id="unit" class="form-control select2 calc">
				<option value="">select a unit</option>
				@foreach($units as $unit)
                <option value="{{$unit->id}}">{{$unit->unitname}}</option>
				@endforeach
				
			</select>
		</td>
      <td><strong>Quntity</strong></td>
    <td>
       <input type="text" id="qty" class="form-control calc" placeholder="Enter Quantity Here" autocomplete="off" value="1">
    </td>

		
	</tr>
	<tr>
	
		<td><strong>MRP</strong></td>
		<td><input type="text" placeholder="Enter Item MRP" class="form-control calc" id="mrp" autocomplete="off" value="0"></td>


    	<td><strong>Discount(in ruppes)</strong></td>
		<td>
	     <input type="text" id="discount" class="form-control calc" autocomplete="off" value="0">
		</td>
		<td><strong>Price</strong></td>
		<td><input type="text" class="form-control calc" id="price" autocomplete="off" readonly="" value="0"></td>
		

		
	</tr>
 
	<tr>
    
		<td><strong>SGST RATE(in %)</strong></td>
		<td><input type="text" class="form-control calc" id="sgstrate" autocomplete="off" value="0"></td>
		<td><strong>SGST COST</strong></td>
		<td>
	     <input type="text" id="sgstcost" class="form-control calc" readonly="" autocomplete="off">
		</td>

		
	</tr>
     <tr>
      
		<td><strong>CGST RATE(in %)</strong></td>
		<td><input type="text" class="form-control calc" id="cgstrate" autocomplete="off" value="0"></td>
		<td><strong>CGST COST</strong></td>
		<td>
	     <input type="text" id="cgstcost" class="form-control calc" readonly="" autocomplete="off">
		</td>

		
	</tr>

	 <tr>
    
		<td><strong>IGST RATE(in %)</strong></td>
		<td><input type="text" class="form-control calc" id="igstrate" autocomplete="off" value="0"></td>
		<td><strong>IGST COST</strong></td>
		<td>
		<input type="text" id="igstcost" class="form-control calc" readonly="" autocomplete="off">
		</td>

		
	</tr>
	 <tr>
    
		   <td><strong>GROSS AMOUNT</strong></td>
		<td><input type="text" class="form-control" id="grossamt" autocomplete="off" readonly=""></td>
		<td></td>
		<td><button type="button" id="addnew" class="addauthor btn btn-primary">ADD</button></td>

		
	</tr>
   </table> 
      

	<table class="table table-responsive table-hover table-bordered table-striped">
	    <tr class="bg-navy">
		 <td class="text-center">ADDED REQUISITIONS DETAILS</td>
	    </tr>
    </table>
    <table class="table table-responsive table-hover table-bordered table-striped">
    	<thead>
    		<tr class="bg-primary">
    	<td>Item Name</td>
			<td>Units</td>
			<td>Qty</td>
			<td>MRP</td>
			<td>Discount</td>
			<td>Price</td>
      <td>SGST Rate</td>
      <td>SGST Cost</td>
			<td>CGST Rate</td>
			<td>CGST Cost</td>
			
			<td>IGST Rate</td>
			<td>IGST Cost</td>
			<td>AMOUNT</td>
    		<th>REMOVE</th>
           </tr>
    	</thead>
       <tbody class="addnewrow sortable">
            
			
									 
	    </tbody>	
    </table>
    <table class="table table-responsive table-hover table-bordered table-striped">
	    <tr class="bg-navy">
		 <td class="text-center">AMOUNT DETAILS</td>
	    </tr>
    </table>

	<table class="table">
	    	<tr>
	    		<td width="50%"><strong>Total MRP</strong></td>
	    		<td width="50%"><input type="text" id="tmrp" name="tmrp" class="form-control" readonly="" required=""></td>
	    	</tr>
	    	<tr>
	    		<td width="50%"><strong>Total Discount</strong></td>
	    		<td width="50%"><input type="text" class="form-control" id="tdiscount" name="tdiscount" readonly=""></td>
	    	</tr>
	    	<tr>
	    		<td width="50%"><strong>Total Price</strong></td>
	    		<td width="50%"><input type="text" class="form-control" id="tprice" name="tprice" readonly="" required=""></td>
	    	</tr>
	    	<tr>
	    		<td width="50%"><strong>Total Quantity</strong></td>
	    		<td width="50%"><input type="text" class="form-control" id="tqty" name="tqty" readonly="" required=""></td>
	    	</tr>

	    	<tr>
	    		<td width="50%"><strong>Total SGST</strong></td>
	    		<td width="50%"><input type="text" class="form-control" id="tsgst" name="tsgst" readonly=""></td>
	    	</tr>
	    	<tr>
	    		<td width="50%"><strong>Total CGST</strong></td>
	    		<td width="50%"><input type="text" class="form-control" id="tcgst" name="tcgst" readonly=""></td>
	    	</tr>


	    		<tr>
	    		<td width="50%"><strong>Total IGST</strong></td>
	    		<td width="50%"><input type="text" class="form-control" id="tigst" name="tigst" readonly=""></td>
	    	   </tr>

	    	<tr>
	    		<td width="50%"><strong>Total Amount</strong></td>
	    		<td width="50%"><input type="text" class="form-control" id="totalamt" name="totalamt" readonly="" required=""></td>
	    	 </tr>

	    	<!--  <tr>
	    		<td width="50%"><strong>IT Deduction(in %)</strong></td>
	    		<td width="50%"><input type="text" class="form-control dedcalc" id="itdeduction" name="itdeduction"  value="0"></td>

	    	 </tr>
	    	  <tr>
	    		<td width="50%"><strong>Other Deduction(in %)</strong></td>
	    		<td width="50%"><input type="text" class="form-control dedcalc" id="otherdeduction" name="otherdeduction" value="0"></td>
	    		
	    	 </tr>
	    	  <tr>
	    		<td width="50%"><strong>Final Price</strong></td>
	    		<td width="50%"><input type="text" class="form-control" id="finalamount" name="finalamount" readonly="" required=""></td> -->
	    		
	    	 </tr>
	    	 <tr>
	    	 	<td width="50%"><strong>Attach a invoice copy</strong></td>
	    	 	<td>
	    	 	<input name="invoicecopy" type="file" onchange="readURL(this);" required="">
            <img style="height:250px;width:100px;" alt="noimage" id="imgshow">
               </td>
	    	 </tr>
	</table>		

<table class="table table-responsive">
	<tr>
		<td ><button type="submit" class="btn btn-success pull-right btn-lg" onclick="return confirm('Do You Want to Proceed?')">Submit</button></td>
	</tr>
</table>


</form>



<script type="text/javascript">
  function checkbill(billno)
  {

   var vendorid=$("#vendorid").val();


      $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxcheckbill")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     vendorid:vendorid,
                     billno:billno
                     
                     },

               success:function(data) { 
                    
                     if (data=="success") {
                      alert("This Bill No already Exist");
                     }
               }
             });
  }
	 function readURL(input) {
    

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow')
                    .attr('src', e.target.result)
                    .width(250)
                    .height(250);
          
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
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
          var subtot=$("#totalamt").val();

          var itdedamt=parseFloat(subtot)*(parseFloat(gitdeduction/100));
          var otheramt=parseFloat(subtot)*(parseFloat(gotherdeduction/100));

          var final=Number.parseFloat(parseFloat(subtot)-(parseFloat(itdedamt)+parseFloat(otheramt))).toFixed(2);

          $("#finalamount").val(final);


          

	});
  $( ".calc" ).on("change paste keyup", function() {

    var qty=$("#qty").val();
    if(qty=='') {
           gqty = 0;

          }
          else
          {
            gqty=qty;
          }

    var mrp=$("#mrp").val();
         if(mrp=='') {
           gmrp = 0;
          }
          else
          {
            gmrp=mrp;
          }
       var discount=$("#discount").val();
           if(discount=='') {
           gdiscount = 0;
          }
          else
          {
            gdiscount=discount;
          }
   
   

    var sgstrate=$("#sgstrate").val();
    if(sgstrate=='') {
           gsgstrate = 0;
          }
          else
          {
            gsgstrate=sgstrate;
          }

       var cgstrate=$("#cgstrate").val();
    if(cgstrate=='') {
           gcgstrate = 0;
          }
          else
          {
            gcgstrate=cgstrate;
          }
   
    var igstrate=$("#igstrate").val();
    if(igstrate=='') {
           gigstrate = 0;
          }
          else
          {
            gigstrate=igstrate;
          }
    
    
     
   
   var calprice=Number.parseFloat(parseFloat(gmrp))-(parseFloat(gdiscount)).toFixed(2);;
   $("#price").val(calprice);
 

   var calsgstcost=Number.parseFloat(parseFloat(calprice)*(parseFloat(gsgstrate)/100)*parseFloat(gqty)).toFixed(2);
   $("#sgstcost").val(calsgstcost);
    var calcgstcost=Number.parseFloat(parseFloat(calprice)*(parseFloat(gcgstrate)/100)*parseFloat(gqty)).toFixed(2);
   $("#cgstcost").val(calcgstcost);
 
    var caligstcost=Number.parseFloat(parseFloat(calprice)*(parseFloat(gigstrate)/100)*parseFloat(gqty)).toFixed(2);
   $("#igstcost").val(caligstcost);

  console.log("qty"+parseFloat(gqty));
  console.log();

   var gross=Number.parseFloat((parseFloat(gqty)*parseFloat(calprice))+parseFloat(calsgstcost)+parseFloat(calcgstcost)+parseFloat(caligstcost)).toFixed(2);
   $("#grossamt").val(gross);

  
});


var counter = 0;
var gdtotal = 0;
var count=0;
jQuery('#addnew').click(function(event){
   
	var itemname1 = jQuery('#itemname').val();
	var unitname=$( "#unit option:selected" ).text();
	var unit = jQuery('#unit').val();
	var qty1=jQuery('#qty').val();
	var mrp1=jQuery('#mrp').val();
	var discount1=jQuery('#discount').val();
	var price1=jQuery('#price').val();
	var sgstrate1=jQuery('#sgstrate').val();
	var sgstcost1=jQuery('#sgstcost').val();
	var cgstrate1=jQuery('#cgstrate').val();
	var cgstcost1=jQuery('#cgstcost').val();
	var igstrate1=jQuery('#igstrate').val();
	var igstcost1=jQuery('#igstcost').val();
	var grossamt1=jQuery('#grossamt').val();

   
	if(itemname1!='' && unit!='' && qty1!='' && mrp1!='' && discount1!='' && grossamt1 !='')
	{   
	event.preventDefault();
    counter++;

    var newRow = jQuery('<tr>'+
    	  
    	 '<td>'+itemname1+'<input type="hidden" name="itemname[]" value="'+itemname1+'"></td>'+
    	  '<td>'+unitname+'<input type="hidden" name="unit[]"value="'+unit+'" class="calcin"/></td>'+
    	  '<td>'+qty1+'<input type="hidden" name="qty[]" class="qtycountable" value="'+qty1+'"/></td>'+
          '<td>'+mrp1+'<input type="hidden" name="mrp[]" class="mrpcountable" value="'+mrp1+'"/></td>'+
          '<td>'+discount1+'<input type="hidden" name="discount[]" class="discountcountable" value="'+discount1+'"/></td>'+
          '<td>'+price1+'<input type="hidden" name="price[]" class="pricecountable" value="'+price1+'"/></td>'+
          '<td>'+sgstrate1+'<input type="hidden" name="sgstrate[]" value="'+sgstrate1+'"/></td>'+
          '<td>'+sgstcost1+'<input type="hidden" name="sgstcost[]" class="sgstcountable" value="'+sgstcost1+'"/></td>'+
          '<td>'+cgstrate1+'<input type="hidden" name="cgstrate[]" value="'+cgstrate1+'"/></td>'+
          '<td>'+cgstcost1+'<input type="hidden" name="cgstcost[]" class="cgstcountable" value="'+cgstcost1+'"/></td>'+
          '<td>'+igstrate1+'<input type="hidden" name="igstrate[]" value="'+igstrate1+'"/></td>'+
          '<td>'+igstcost1+'<input type="hidden" name="igstcost[]" class="igstcountable" value="'+igstcost1+'"/></td>'+

    	  '<td>'+grossamt1+'<input type="hidden" name="grossamt[]" class="countable" value="'+grossamt1+'"/></td>'+

    	  '<td><button type="button" class="btn btn-danger remove_field" id="'+counter+'">X</button></td></tr>');
    jQuery('.addnewrow').append(newRow);
    count++;

    sumofduration();
   
   
	}
	else
	{
		alert("Please Fill Up The form Correctly");
	}
	
	
}); 


jQuery(".addnewrow").on("click",".remove_field", function(e){ //user click on remove text
e.preventDefault();
jQuery(this).parent('td').parent('tr').remove(); counter--;
	
sumofduration();

});


    
function sumofduration()
{

     
    var totals = 0;
    var mrpcountable=0;
    var discountcountable=0;
    var pricecountable=0;
    var sgstcountable=0;
    var cgstcountable=0;
    var igstcountable=0;
    var qtycountable=0;
   


    $('.countable').each(function (index, element) {
         totals=totals+parseFloat($(element).val());
        //totals = Number.parseFloat(totals + parseFloat($(element).val())).toFixed(2);
        
    });
    
    $('.mrpcountable').each(function (index, element) {
       mrpcountable=mrpcountable + parseFloat($(element).val());

        
       // mrpcountable = Number.parseFloat(mrpcountable + parseFloat($(element).val())).toFixed(2);
    });
   
    $('.discountcountable').each(function (index, element) {

       discountcountable=discountcountable + parseFloat($(element).val());
        //discountcountable =Number.parseFloat( discountcountable + parseFloat($(element).val())).toFixed(2);
    });
    $('.pricecountable').each(function (index, element) {
        pricecountable=pricecountable + parseFloat($(element).val());
        //pricecountable = Number.parseFloat(pricecountable + parseFloat($(element).val())).toFixed(2);
    });
    $('.sgstcountable').each(function (index, element) {
        sgstcountable=sgstcountable + parseFloat($(element).val());
       // sgstcountable = Number.parseFloat(sgstcountable + parseFloat($(element).val())).toFixed(2);
    });
    $('.cgstcountable').each(function (index, element) {

       cgstcountable=cgstcountable + parseFloat($(element).val());
       // cgstcountable = Number.parseFloat(cgstcountable + parseFloat($(element).val())).toFixed(2);
    });
    $('.igstcountable').each(function (index, element) {
         igstcountable=igstcountable + parseFloat($(element).val());
        //igstcountable = Number.parseFloat(igstcountable + parseFloat($(element).val())).toFixed(2);
    });
    $('.qtycountable').each(function (index, element) {
        qtycountable=qtycountable + parseFloat($(element).val());
       // qtycountable = Number.parseFloat(qtycountable + parseFloat($(element).val())).toFixed(2);
    });
    
    $("#totalamt").val(Number.parseFloat(Math.round(totals)).toFixed(2));
    $("#finalamount").val(Number.parseFloat(totals).toFixed(2));
    $("#tmrp").val(Number.parseFloat(mrpcountable).toFixed(2));
    $("#tdiscount").val(Number.parseFloat(discountcountable).toFixed(2));
    $("#tprice").val(Number.parseFloat(pricecountable).toFixed(2));
    $("#tsgst").val(Number.parseFloat(sgstcountable).toFixed(2));
    $("#tcgst").val(Number.parseFloat(cgstcountable).toFixed(2));
    $("#tigst").val(Number.parseFloat(igstcountable).toFixed(2));
    $("#tqty").val(Number.parseFloat(qtycountable).toFixed(2));
    

   
}

</script>
@endsection