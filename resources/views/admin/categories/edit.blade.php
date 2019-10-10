@extends('layouts.admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h1>Редактировать категорию</h1>
        <br>
        <form method="post">
            {!! csrf_field() !!}
            <p>Введите наименование категории<br><input type="text" name="title" class="form-control" value="{{$category->title}}" required></p>
            <p>Текст категории<br><textarea name="description" class="form-control">{!! $category->description !!}</textarea> </p>
            <button type="submit" class="btn btn-success">Редактировать</button>
        </form>
    </main>
@stop
