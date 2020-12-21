@extends('layouts.app')

@section('title-block')Результаты поиска@endsection

@section('content')
@foreach ($data as $el)


<div class="container ml-5" id="result">
  <div class="row">
    <div class="col-sm">
      game:{{$el[0]}}
    </div>
  </div>
  <div class="row">
    <div class="col-sm">
      price:{{$el[1]}}
    </div>
  </div>
  <div class="row">
    <div class="col-sm">
      Site: <a  href="{{$el[2]}}" rel="noopener noreferrer" target="_blank" id="link">{{$el[2]}}</a>
    </div>
  </div>
</div>
<p></p>
@endforeach
@endsection
