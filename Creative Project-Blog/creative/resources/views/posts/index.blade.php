@extends('vendor.main')

@section('title','| All Topics')
@section('content')
 	<div class="row">
 		<div class="col-md-10">
 			<h1>All Topics</h1>
 		</div>
 		@if(Auth::check())
 		<div class="row">
 		<div class="col-md-8 col-lg-offset-2">
 			<a href="{{route('posts.create')}}" class="btn btn-lg btn-block btn-info btn-h1-spacing" >create new topic</a>
 			<a href="{{route('posts.newcreate')}}" class="btn btn-lg btn-block btn-info btn-h1-spacing" >create anonymously</a>
 		</div></div>
 		@else

 		@endif

 	</div>
 	<br>

 	<div class="row" style="font-size:16px">
 	<div class="col-md-2"></div>
 		<div class="col-md-8" style="font-size:16px">

 				<hr>
 				@foreach ($posts as $post)

		<div class="row">
			<div class="format-image group">
			    <h2 class="post-title pad">
			        {{ $post->heading }}
			    </h2>
			    <br>
			    <div class="post-inner col-md-8">
			        <div class="post-content pad">
			                {{ substr($post->content, 0, 500) }}{{ strlen($post->content) > 500 ? "......" : "" }}
			        </div>
			    </div>
			</div>
		</div>


							<br>
							  {{-- show only first 50 words --}}
							  <div class="row">
								  <div class="text-left">
			                           <br><span class="glyphicon glyphicon-check"></span> Created at:
										{{ date('M j Y  H:i', strtotime($post->created_at)) }}
										<br><span class="glyphicon glyphicon-user"></span> Author:
										{{ ($post->writer) }}
								 </div>
								 <div class="text-right">
	 							    <a href="{{route('posts.show', $post->id) }}" class="btn btn-primary btn-sm">Read More</a> 
	 							    <a href="{{$post->user_id ==Auth::id()? route('posts.edit', $post->id):url('/')}}" class="btn btn-primary btn-sm">{{$post->user_id ==Auth::id()? 'Edit':'Refresh'}}</a>
 

	 							    <hr> 
							    </div>
						    </div>
 							 					
 						@endforeach

 		</div>
 	</div>
@endsection