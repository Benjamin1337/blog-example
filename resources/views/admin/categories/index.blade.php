@extends('layouts.admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h1 class="my-4">Панель управления<br>
            <small>Категории</small>
        </h1>
        <br>
        <a href="{!!  route('categories.add') !!}" class="btn btn-info">Добавить категорию</a>
        <br>
        <br>
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Наименование</th>
                <th>Описание</th>
                <th>Дата добавления</th>
                <th>Действия</th>
            </tr>
            @foreach($categories as $category)
                <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->title }}</td>
                <td>{!! $category->description !!}</td>
                <td>{{ $category->created_at->format('d-m-Y H:i') }}</td>
                <td><a href="{!! route('categories.edit', ['id' => $category->id]) !!}">Редактировать</a> |
                    <a href="" class="delete" rel="{{ $category->id }}">Удалить</a></td>
                </tr>
            @endforeach
        </table>
    </main>
@stop

@section('js')
    <script>
        $(function () {
            $('.delete').on ('click', function () {
                if (confirm('Вы дйствительно хотите удалить эту запись?')) {
                    let id = $(this).attr("rel");
                    $.ajax({
                        type: "DELETE",
                        url: "{!! route('categories.delete') !!}",
                        data: {_token:"{{csrf_token()}}", id:id},
                        success: function() {
                            alertify.alert(" Успешно удалено ");
                            alertify.success("{!! session()->get('success')  !!}");
                            // location.reload();
                        },
                        error: function () {
                            alertify.alert(" Ошибка ");
                            alertify.error("{!! session()->get('error')  !!}");
                        }
                    })
                } else {
                    alertify.error("Действие отменено пользователем");
                }
            })
        })
    </script>
@stop