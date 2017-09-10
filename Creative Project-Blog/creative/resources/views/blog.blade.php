@extends('layouts.layout')

@section('content') 
<section>
        <title>ADD A STORY</title>
</head>
<body>
<div class="main_add">
<form method="post" action="{{url('blog')}}" >
{!! csrf_field() !!}
    <label>Title: <input type="text" size=32 name="title"></label>
    <label>Story text: <textarea cols="30" rows="9" name=story_content></textarea></label>
    <input type="submit" name="Add Story Submit">

</form>
</section>
@endsection