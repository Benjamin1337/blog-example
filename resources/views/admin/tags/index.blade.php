@extends('layouts.admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h1 class="my-4">Панель управления<br>
            <small>Тэги</small>
        </h1>
        <br>
        <a href="{!!  route('tags.add') !!}" class="btn btn-info">Добавить тэг</a>
        <br>
        <br>
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Наименование</th>
                <th>Цвет</th>
                <th>Дата добавления</th>
                <th>Действия</th>
            </tr>
            @foreach($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->name }}</td>
                    <td>{{ $tag->color }}</td>
                    <td>{{ $tag->created_at }}</td>
                    <td><a href="{!! route('tags.edit', ['id' => $tag->id]) !!}">Редактировать</a> |
                        <a href="" class="delete" rel="{{ $tag->id }}">Удалить</a></td>
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
                        url: "{!! route('tags.delete') !!}",
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