@extends('layouts.app')

@section('title-block')Главная@endsection

@section('content')
<h1>Мониторинг игр с наименьшей стоимостью</h1>
<p>зачем платить больше.?</p>
<div class="d1">
  <form action="{{ route('search-form') }}" method="post">
    @csrf
    <input id="inp" name="Search" placeholder="Введите название игры..." type="search">
    <button type="submit">Найти</button>
  </form>
</div>
@endsection
