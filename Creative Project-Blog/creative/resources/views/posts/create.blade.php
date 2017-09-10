@extends('vendor.main')
@section('title','| Create New Post')
@section('stylesheets')
{!!Html::style('css/parsley.css')!!}
@endsection
@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
	<h1>Create New Post</h1>
    <hr>
    {!! Form::open(['route' => 'posts.store','data-parsley-validate'=>'']) !!}
     {{Form::label('heading','Heading:')}}
     {{Form::text('heading',null,array('class'=>'form-control','required'=>'','maxlength'=>'255'))}}
     {{Form::label('content',"Content:")}}
     {{Form::textarea('content',null,array('class'=>'form-control','required'=>''))}}
     <br>
     <div class="col-md-4">
      {{ Form::label('category_id', 'Category:') }}
                <select class="form-control" name="category_id">
                    @foreach($categories as $category)
                        <option value='{{ $category->id }}'>{{ $category->name }}</option>
                    @endforeach

                </select>
     </div>
      <div class="col-md-4 col-md-offset-8">
        
     {{Form::submit('Create New Post',array('class'=>'btn btn-success btn-lg btn-block','style'=>'margin-top: 20px;margin-right=-20px;'))}}
     </div>
    {!! Form::close() !!}

	</div>
</div>

    
@endsection
