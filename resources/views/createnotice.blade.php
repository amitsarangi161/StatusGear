@extends('layouts.hr')
@section('content')
<!-- <link rel="stylesheet" type="text/css" href="{{asset('/css/editor.css')}}"> -->
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-navy">
		 <td class="text-center">NOTICE</td>
	</tr>
</table>
<form action="/savenotice" method="POST" enctype="multipart/form-data">
	{{csrf_field()}}
@if(Session::has('msg'))
<p class="alert {{ Session::get('alert-class', 'alert-success') }} text-center" style="font-weight: bold;text-transform: capitalize;">
{{ Session::get('msg') }}</p>
@endif
<table class="table">

	<tr>
		<td><strong>NOTICE SUBJECT <p style="color: red">*</p></strong></td>
		<td><input type="text" name="subject" class="form-control" placeholder="Enter Notice Subject" required="" autocomplete="off"></td>
	</tr>
	<tr>
		<td><strong>NOTICE DESCRIPTION <p style="color: red">*</p></strong></td>
		<td>	
<textarea class="form-control textarea" name="description" rows="12"></textarea>
		</td>
	</tr>
	<tr>
		<td><strong>ATTACHMENT</strong></td>
		<td>	
          <input type="file" name="attachment" class="form-control">
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: right;">
			<button class="btn btn-success btn-lg" type="submit" onclick="return confirm('Do You want to Save this Notice?')">SAVE</button>
		</td>
	</tr>
	
</table>
</form>
<!-- <script type="text/javascript" src="{{asset('/js/tinyeditor.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/editor.js')}}"></script> -->
<!-- <script type="text/javascript">
	$('.textarea').wysihtml5();
</script>
@endsection