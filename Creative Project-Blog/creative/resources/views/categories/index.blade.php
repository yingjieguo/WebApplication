@extends('vendor.main')

@section('title', '| All Categories')

@section('content')



	<div class="row">
		<div class="col-md-2">
			<h3>Categories</h3>
			<table class="table table table-striped">
				<thead>
					<tr>
						<th>Name</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($categories as $category)
					<tr>
						<td>{{ $category->name }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
<br>
<div class="row">
		<div class="col-md-3 col-lg-offset-2">

				{!! Form::open(['route' => 'categories.store', 'method' => 'POST']) !!}
					<h2>New Category</h2>
					<br>
					{{ Form::label('name', 'Name:') }}
					<br>
					{{ Form::text('name', null, ['class' => 'form-control']) }}
					<br>

					{{ Form::submit('Create New Category', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}
				
				{!! Form::close() !!}
			</div>
</div>



@endsection

