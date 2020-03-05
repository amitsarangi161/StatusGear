@extends('layouts.tender')
@section('content')
@inject('provider', 'App\Http\Controllers\TenderController')
<style type="text/css">
    .b {
    white-space: nowrap; 
    width: 120px; 
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
<table class="table">
	<tr class="bg-navy">
		<td class="text-center">TENDER LIST FOR ADMIN APPROVAL</td>
		
	</tr>
</table>
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped datatable">
	<thead>
<tr class="bg-blue">
			<td>ID</td>
			<td>NAME OF WORK</td>
			<td>CLIENT</td>
			<td>SOURCE</td>
			<td>WORK VALUE</td>
			<td>LAST DATE OF SUB.</td>
			<td>ASSIGNED USER</td>
			<td>CREATED AT</td>
			<td>VIEW</td>
</tr>
</thead>
<tbody>
	 @foreach($tenderarr as $tend)
	    <tr>
	    	<td><a href="/viewtender/{{$tend['tender']->id}}" target="_blank" class="btn btn-info">{{$tend['tender']->id}}</a></td>
	    	<td><p class="b" title="{{$tend['tender']->nameofthework}}">{{$tend['tender']->nameofthework}}</p></td>
		   	<td>{{$tend['tender']->clientname}}</td>
		   	<td>{{$tend['tender']->source}}</td>
		   	<td>{{$tend['tender']->workvalue}}</td>
		   	<td data-sort="{{strtotime($tend['tender']->lastdateofsubmisssion)}}">{{$provider::changedateformat($tend['tender']->lastdateofsubmisssion)}}</td>
		   	<td>
		   		<ol>
		   		@foreach($tend['tenderusers'] as $user)
                   <li>{{$user['name']}}<strong>({{$user->status}})</strong></li>
		   		@endforeach
		   		</ol>
		   	</td>
		   	<td data-sort="{{strtotime($tend['tender']->created_at)}}">{{$provider::changedatetimeformat($tend['tender']->created_at)}}</td>
		   	<td><a href="/viewtender/{{$tend['tender']->id}}" class="btn btn-info" target="_blank">VIEW</a></td>
	    </tr>

	 @endforeach
</tbody>
</table>
@endsection