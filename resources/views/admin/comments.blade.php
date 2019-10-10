@extends ('layouts.admin')

@section('content')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="my-4">Панель управления<br>
                <small>Комментарии</small>
            </h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                    <span data-feather="calendar"></span>
                    This week
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Статья</th>
                    <th>Пользователь</th>
                    <th>Комментарий</th>
                    <th>Статус</th>
                    <th>Дата добавления</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>{{_getArticle($comment->article_id)->title}}</td>
                            <td>{{_getUser($comment->user_id)->username}}</td>
                            <td>{{$comment->comment}}</td>
                            <td>@if ($comment->status) Активен @else На модерации <a href="{!! route('comments.accepted', ['id' => $comment->id]) !!}">Добавить</a>@endif </td>
                            <td>{!! $comment->created_at->format('d.m.Y H:i') !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@stop