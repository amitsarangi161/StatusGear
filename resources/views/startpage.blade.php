@extends('layouts.start')
@section('content')
<marquee style="background: #00ff16;">
	<strong style="line-height: 3;font-weight: bold;font-size: 16px;">Welcome To Subudhi Techno Engineers Pvt.ltd</strong>
</marquee>
<div class="inner">
<div class="notice-section">
<div class="container-fluid">
	<div class="row">
<div class="col-md-5">
	<div class="ideaboxNews2 in-easing">
		<h3 class="text-center">Notice</h3>
	    <ul>
	    	<marquee direction="up" behavior="scroll" scrolldelay="100" scrollamount="2" onmouseenter="this.stop();" onmouseleave="this.start();" height="100%">
	    	@foreach($notices as $notice)
	        <a href="/viewnoticehome/{{$notice->id}}">
	        	<li>
	            <div class="in-content">
	            	<h2>{{$notice->subject}} <img src="new.gif" alt="new" title="New" width="35" height="15" border="0"></h2>
	                <span><i class="far fa-clock" aria-hidden="true"></i>;&nbsp;&nbsp;{{ date('d-m-Y H:i:s', strtotime($notice->created_at)) }}</span>
	                <div>
	               {{$notice->description}}
	                </div>
	            </div>
	        	</li>
	        </a> 
	        @endforeach

	    	</marquee>
		</ul>
		<a href="/view-all-notice-home"><h6 class="pull-right">view all notice</h6></a>
	</div>
</div>
    <div class="col-md-5 col-md-offset-2">
	    <div class="ideaboxNews in-easing">
	    	<h3 class="text-center">Documents</h3>
	        <ul>
	        	<marquee direction="up" behavior="scroll" scrolldelay="100" scrollamount="2" onmouseenter="this.stop();" onmouseleave="this.start();" height="100%">
	        @foreach($documents as $document)
	            <a href="/view-all-documents">
	            	<li>
	                <div class="in-content">
	                	<h2>{{$document->docname}}<img src="new.gif" alt="new" title="New" width="35" height="15" border="0"></h2>
	                   <span style="color:black;"> <i class="far fa-clock" aria-hidden="true"></i>&nbsp;&nbsp;{{ date('d-m-Y H:i:s', strtotime($document->created_at)) }}</span>
	                   
	                </div>
	            </li>
	            </a> 
	           @endforeach
	           

	            
	           
	          
	            
	         </marquee>


	        </ul>

	    </div>
</div>
</div>
</div>
</div>
<div class="container">
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
	<div class="chat-popup" id="myForm">
		  <form action="" class="form-container">
		    <h4 class="text-center headtext">Suggestion<span class="pull-right sclose" onclick="closeForm();"><i class="fa fa-times"></i></span></h4>
		    <textarea placeholder="Write a Suggestion,Your Suggestion counts.." name="msg" required id="description"></textarea>

		    <button type="button" onclick="savesuggestion();" class="btn sendbtn">Send</button>
		    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
		  </form>
		</div>
	</div>
</div>
<section class="suggestion simg">
<div class="container-fluid">
<div class="row">
	<!-- <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
		<img src="sug3.png" class="img-responsive kl" onclick="openForm()" style="cursor: pointer;">
	</div> -->
	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-lg-offset-4 col-sm-offset-3 col-md-offset-4">
		<a href="https://play.google.com/store/apps/details?id=com.subudhitechno.engineers.statusgear&hl=en"><img src="android.png" class="img-responsive kl center-block" style="cursor: pointer;"></a>
	</div>
</div>
</div>
</section>

<div id="chat-circle" class="btn btn-warning" onclick="openForm()">
        
		    <i class="material-icons">
		    	<i class="far fa-comments" aria-hidden="true" style="font-size: 20px;">
		    		
		    	</i>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Any Suggestion?</strong>
		    </i>
</div>
</div>
<script>
	$(document).ready(function(e) {
        $(".ideaboxNews").ideaboxNews({
			maxwidth		:'100%',
			newscount		:5,
			position		:'relative',
			openspeed		:'fast'
		});
    });

   
</script>
<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
  $("#description").val('');
}

function savesuggestion()
{

	var description=$("#description").val();
	if(description!='')
	{
		 $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxsavesuggestion")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      description:description,
                     
                     },

               success:function(data) { 
                    $("#description").val('');
                     document.getElementById("myForm").style.display = "none";
               }
             });
	}
	else
	{
		alert("Suggestion Can't be Blank");
	}
	
}
</script>
</body>
</html>
@endsection