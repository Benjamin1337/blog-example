@extends('layouts.admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h1>Добавить тэг</h1>
        <br>
        <form method="post">
            {!! csrf_field() !!}
        <p>Введите наименование тэга<br><input type="text" name="name" class="form-control" required></p>
        <p>Цвет тэга<br><input name="color" class="form-control"> </p>
        <button type="submit" class="btn btn-success">Добавить</button>
        </form>
    </main>
@stop