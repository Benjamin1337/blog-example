@extends ('layouts.app')


@section('content')
<article>
<div class="container">

    <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

            <!-- Title -->
            <h1 class="mt-4">{!! $article->title !!}</h1>

            <!-- Author -->
            <div class="">
            <span class="text-left">
                от
                <a href="{{$article->user['user_id']}}">{{$article->user['user_name']}}</a>
            </span>
            <br>
            <!-- Date/Time -->
            <span class="text-right d-inline-flex">Опубликовано
                в {!! $article->created_at->format('H:i - d/m/Y') !!}</span>
            </div>
            <hr>
            <div class="mb-3" style="height: 20px;">
                @foreach($tags as $tag)
                    <a href="/tags/{{$tag->id}}" style="height: 100%;" class="d-inline-block badge badge-secondary"><span class="m-1">{{ $tag->name }}</span></a>
                @endforeach
            </div>

            <!-- Preview Image -->
            <img class="img-fluid rounded" src="{{ asset('/storage/' . $article->image['file_name']) }}" alt="">

            <hr>

            <!-- Post Content -->
            <p class="lead">{!! $article->short_text !!}</p>

            <p style="max-width: 730px">{!! $article->full_text !!}</p>
            <div class="card-interaction" data-post-id="{{ $article->article_id }}">
                @if(Auth::check())
                    <a href="" class="badge like">{{ Auth::user()->like()->where('article_id', $article->article_id)->first() ? Auth::user()->like()->where('article_id', $article->article_id)->first()->like == 1 ? 'Вам понравилось' : 'Мне нравится' : 'Мне нравится' }}</a> |
                    <a href="" class="badge like">{{ Auth::user()->like()->where('article_id', $article->article_id)->first() ? Auth::user()->like()->where('article_id', $article->article_id)->first()->like == 0 ? 'Вам не понравилось' : 'Мне не нравится' : 'Мне не нравится' }}</a>

                @endif
                <p class="badge like-count">Понравилось: {{ $article->totalLikes->count()}}</p>
                <p class="badge view-count">Просмотры: {{ $article->view_count}}</p>
            </div>

            <hr>

            <!-- Comments Form -->
            @if(\Auth::check())
            <div class="card my-4">
                <h5 class="card-header">Оставте комментарий:</h5>
                <div class="card-body">

                    <form method="post" action="{!! route('comments.add') !!}">
                        {!! csrf_field() !!}
                        <input type="hidden" value="{{$article->article_id }}" name="article_id">
                        <div class="form-group">
                            <textarea class="form-control" name="comment" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            @endif

            <!-- Single Comment -->
            @foreach($comments as $comment)
                <div class="media mb-4 comment">
                    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                    <div class="media-body">
                        <h5 class="mt-0">{{_getUser($comment->user_id)->user_name}}
                        <small>{{$comment->created_at->format('H:i - d/m/Y')}}</small></h5>
                        {!! $comment->comment !!}
                    </div>
                </div>
            @endforeach

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Search Widget -->
            <div class="card my-4">
                <h5 class="card-header">Поиск статьи</h5>
                <div class="card-body">
                    <div class="">
                        <form action="/search" method="get">
                            <input id="search_form" type="text" name="search" class="form-control" placeholder="Поиск...">
                        </form>
                    </div>
                </div>
            </div>

            <!-- Categories Widget -->
            <categories>
                <div class="card my-4">
                    <h5 class="card-header">Популярные категории</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="list-unstyled mb-0">

                                    @foreach($categories as $category)

                                        <li>
                                            <a href="/categories/{{ $category->id }}">{{$category->title}}</a>
                                        </li>

                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </categories>

            <!-- Side Widget -->
            <div class="card my-4">
                <h5 class="card-header">Популярные теги</h5>
                <div class="card-body">
                    @foreach($all_tags as $tag)
                        <a href="/tags/{{$tag->id}}" style="height: 100%;" class="d-inline-block badge badge-secondary"><span class="m-1">{{ $tag->name }}</span></a>
                    @endforeach
                </div>

        </div>

            <posts>
                <div class="card my-4">
                    <h5 class="card-header">Смотрите также
                        <small>{{$article->categories[0]->title}}</small></h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="list-unstyled mb-0">

                                    @foreach($similiar_articles[0] as $sa)

                                        <li>
                                            <a href="{!! route('blog.show', [
                                    'id' => $sa->article_id,
                                    'slug' => str_slug($sa->title),
                                    ]) !!}">{{$sa->title}}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </posts>

    </div>

    </div>
</div>
</article>

<script src="{{asset('/js/like.js')}}"></script>
<script type="text/javascript">
    var token = '{{csrf_token()}}';
    var urlLike = '{{ route ('like') }}';
</script>

@stop