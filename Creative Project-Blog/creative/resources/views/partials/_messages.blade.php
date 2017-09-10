@if (session()->has('Success'))
<div class="alert alert-success" role="alert">
	<strong>Success:</strong> {{ session()->get('Success')}}
</div>

@endif

@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
	<strong>
		Errors:
	</strong>
	<ul>
	@foreach ($errors->all() as $error)
		<li>{{$error}}</li>
	@endforeach
	</ul>
</div>
@endif
