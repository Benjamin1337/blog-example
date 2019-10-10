@extends('layouts.app')


@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h2>Добро пожаловать, {{\Auth::user()->email}}</h2>
            <br>
        @if (\Auth::user()->adminPermissions == 1)
            <a href="{{route('admin')}}">Панель управления</a>
            <br>
        @endif
    </div>
</main>
@stop
