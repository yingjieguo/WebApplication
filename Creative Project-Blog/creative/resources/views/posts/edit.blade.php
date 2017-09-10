@extends('vendor.main')

@section('title','| Edit Your Blog')

@section('content')
<div class="row">
{!!Form::model($post,['route' => ['posts.update', $post->id],'method'=>'PATCH'])!!}

    <div class="col-md-8">
        {{Form::label('heading','New Heading:')}}
         {{Form::text('heading',null,["class"=> 'form-control input-lg'])}}
        {{Form::label('content',"New Content: ",['class'=>'form-spacing-top'])}}
         {{Form::textarea('content',null,["class"=> 'form-control'])}}

         {{ Form::label('category_id', "Category:", ['class' => 'form-spacing-top']) }}
			{{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
       
    </div>
	
	<div class="col-md-4">
		<br>
		    <dl class="dl-horizontal">
				<dt>Create at:</dt>
				<dd>{{ date('jS F Y  H:i',strtotime($post['created_at'])) }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Last Update:</dt>
				<dd>{{ date('jS F Y  H:i',strtotime($post['updated_at'])) }}</dd>
			</dl>

			<div class="row">

				<div class="col-sm-6 col-lg-offset-2">

					  {!! Html::linkRoute('posts.show','Cancel the change',array($post['id']) ,array('class'=>'btn btn-danger btn-block btn-sm'))!!}
					{{-- <a href="#" class="btn btn-primary btn-block">Edit</a> --}}
				</div>
				<div class="col-sm-4">
				        {{Form::submit('Save',['class'=>'btn btn-success btn-block btn-sm'])}}
					{{-- <a href="#" class="btn btn-danger btn-block">Delete</a> --}}
				</div>
				{{-- <div class="col-sm-4">
				{!! Form::open(['route'=>['posts.destroy',$post['id']],'method'=>'DELETE']) !!}
					<a href="#" class="btn btn-danger btn-block">Delete</a>
                {!! Form::submit('Delete',['class'=>'btn-danger btn-block btn-sm']) !!}
				{!! Form::close() !!}
				</div> --}}
			</div>
		</div>

	</div>
{!!Form::close()!!}</div>
@endsection
