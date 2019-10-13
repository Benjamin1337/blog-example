@extends('layouts.admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h1 class="my-4">Панель управления<br>
            <small>Пользователи</small>
        </h1>
        <br>
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Ник</th>
                <th>E-mail</th>
                <th>Роль</th>
                <th>Дата регистрации</th>
                <th>Действия</th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->user_id }}</td>
                    <td>{{ $user->user_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>@if ($user->adminPermissions) Администратор
                        @else                         Пользователь @endif</td>
                    <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
                    <td><a href="#">Забанить</a> |
                        <a href="" class="delete" rel="{{ $user->id }}">Удалить</a></td>
                </tr>
            @endforeach
        </table>
    </main>
@stop

@section('js')
    <script>
        /*$(function () {
            $('.delete').on ('click', function () {
                if (confirm('Вы дйствительно хотите удалить эту запись?')) {
                    let id = $(this).attr("rel");
                    $.ajax({
                        type: "DELETE",
                        url: "",
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
        })*/
    </script>
@stop