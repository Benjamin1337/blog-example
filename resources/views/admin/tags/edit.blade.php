@extends('layouts.admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h1>Редактировать тэг</h1>
        <br>
        <form method="post">
            {!! csrf_field() !!}
            <p>Введите наименование тэга<br><input type="text" name="name" class="form-control" value="{{$tags->name}}" required></p>
            <p>Цвет категории<br><input name="color" class="form-control" value="{!! $tags->color !!}"> </p>
            <button type="submit" class="btn btn-success">Редактировать</button>
        </form>
    </main>
@stop
