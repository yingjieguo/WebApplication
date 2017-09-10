
@extends('vendor.main')

@section('title','| View')

@section('content')
<div class="row">
    <div class="col-md-7 col-md-offset-1">
        <h1><span class="glyphicon glyphicon-paperclip"></span>{{ $post['heading']}}</h1>
        <p class="lead">
        <br>
            <span class="glyphicon glyphicon-ice-lolly-tasted"></span>{{$post['content']}}
        </p>
        <p> <span class="glyphicon glyphicon-info-sign"></span>	Posted In Category: {{ $post->category->name }}</p>
    </div>


	<div class="col-md-4 ">
{{-- 		<div class="well"> --}}
		<br>
			<dl class="dl-horizontal">
				<dt> <span class="glyphicon glyphicon glyphicon-pencil"></span> Create at:</dt>
				<dd>{{ date('jS F Y  H:i',strtotime($post['created_at'])) }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt><span class="glyphicon glyphicon-time"></span> Last Update:</dt>
				<dd>{{ date('jS F Y  H:i',strtotime($post['updated_at'])) }}</dd>
			</dl>
			
			<div class="row">
			<div class="col-sm-4"></div>
				@if (Auth::id()==$post['user_id'])
				<div class="col-sm-4">
					  {!! Html::linkRoute('posts.edit','Edit',array($post['id']) ,array('class'=>'btn btn-primary btn-block btn-sm'))!!}
					{{-- <a href="#" class="btn btn-primary btn-block">Edit</a> --}}
				</div>
				<div class="col-sm-4">
				{!! Form::open(['route'=>['posts.destroy',$post['id']],'method'=>'DELETE']) !!}
					{{-- <a href="#" class="btn btn-danger btn-block">Delete</a> --}}
                {!! Form::submit('Delete',['class'=>'btn-danger btn-block btn-sm']) !!}
				{!! Form::close() !!}
				</div>
				@else

				@endif

			</div>
		{{-- </div> --}}
	</div>
	</div>
<br>
<hr>
	<div class="row">
			<div class="col-md-8 col-md-offset-2">

				@foreach($post->comments as $comment)
					<div class="comment">
						<p><span class="glyphicon glyphicon-user"></span><strong>  Name:</strong> {{ $comment->name }}</p>
						<p><span class="glyphicon glyphicon-envelope"></span><strong>  Email:</strong> {{ $comment->email }}</p>
						<p><span class="glyphicon glyphicon-comment"></span><strong>  Comment:</strong><br/>{{ $comment->comment }}</p>
					</div>
					<hr>
				@endforeach
			</div>
		</div>

    @if (Auth::id()!=$post['user_id']&&Auth::check())
    <div class="row">
		<div id="comment-form" class="col-md-8 col-md-offset-2" style="margin-top: 50px;">
			{{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) }}
				
				<div class="row">
					{{-- <div class="col-md-6">
						<span class="glyphicon glyphicon-user"></span> {{ Form::label('name', "Name:") }}
						{{ Form::text('name', null, ['class' => 'form-control']) }}
					</div>

					<div class="col-md-6">
						<span class="glyphicon glyphicon-envelope"></span> {{ Form::label('email', 'Email:') }}
						{{ Form::text('email', null, ['class' => 'form-control']) }}
					</div> --}}

					<div class="col-md-12">
						<span class="glyphicon glyphicon-comment"></span> {{ Form::label('comment', "Comment:") }}
						{{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '6']) }}

						{{ Form::submit('Add Comment', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top:15px;']) }}
					</div>
				</div>

			{{ Form::close() }}
		</div>
	</div>
    @else
	

	@endif

@endsection