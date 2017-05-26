@extends('app')

@section('content')
<br/><br/>
<div class="row">
	<div class="col s12">
		<ul class="collection with-header">
			<li class="collection-header"><h5>{{  $rollCall->date }}</h5></li> 
			@foreach ($rollCall->attendances as $attendance)
			<li class="collection-item">{{  $attendance->name }} </li>
			@endforeach
			
		</ul>
	</div>

</div>

@endsection

