@extends('layouts.layout')

@section('content') 
<div class="row">
        <div class="col-sm-12">
            <h3 class="article-heading text-lg">{{$product['heading']}}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-justify text-md">{{$product['content']}}</div>
    </div>
@endsection