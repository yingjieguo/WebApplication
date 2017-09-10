
@extends('layouts.layout')

@section('content')

@foreach($teststring as $item)

<a href="{{route('get-blog',$item['id'])}}">
<div class="row item-list">
<h3>{{$item['heading']}}</h3>
</div>
</a>

@endforeach






@endsection