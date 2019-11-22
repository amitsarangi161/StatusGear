@extends('layouts.app')
@section('content')


<table class="table">
	<tr class="bg-navy">
		<td class="text-center">SHOWING LOCATION OF {{$name}} FOR DATE{{$date}}</td>
		
	</tr>
	
</table>

<table class="table table-responsive table-hover table-bordered table-striped datatable">
	<thead>
	<tr class="bg-blue">
		<th>ID</th>
		<th>LATITUDE</th>
		<th>LONGITUDE</th>
		<th>DEVICE ID</th>
		<th>BATTERY</th>
		<th>LOCATION</th>
		<td>TIME</td>
		
	</tr>
</thead>
<tbody>
	@foreach($addressarr as $key=>$address)
	   <tr>
	   	<td>{{++$key}}</td>
	   	<td>{{$address['latitude']}}</td>
	   	<td>{{$address['longitude']}}</td>
	   	<td>{{$address['deviceid']}}</td>
	   	<td>{{$address['battery']}}</td>
	   	<td>{{$address['address']}}</td>
	   	<td>{{$address['created_at']}}</td>

	   </tr>
	@endforeach
</tbody>
</table>

@endsection