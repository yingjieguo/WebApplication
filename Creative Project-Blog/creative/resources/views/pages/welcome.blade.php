@extends('vendor.main')

@section('title','| blog list')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="jumbotron">
            <h1>Welcome to My Blog!</h1>
            <p class="lead">Thank you so much for visiting. This is my test website built with Laravel. Please read posts!</p>
        </div>
    </div>
</div>

// need change

<div class="row">
    <div class="col-md-8">
        <div class="post">
            <h3>Post Title</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis amet tenetur eum, consequuntur assumenda officiis quidem omnis placeat. Sequi ex fugiat reiciendis at eligendi inventore ad, odio magnam velit doloribus...</p>
            <a href="#" class="btn btn-primary">Read More</a>
        </div>

         <hr>


    <div class="col-md-3 col-md-offset-1">
         <h2>Sidebar</h2>
    </div>
</div>

@endsection