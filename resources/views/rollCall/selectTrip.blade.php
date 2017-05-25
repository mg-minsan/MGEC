@extends('app')

@section('content')
<br/><br/>
<div class="row">
<div class="col s12">
	<div class="collection">

	@foreach ($trips as $trip)

	<a href="{{ url('/trip/' . $trip->id . '/rollcall') }}" class="collection-item">{{  $trip->name }}</a>

	@endforeach

	</div>
</div>

</div>

@endsection

