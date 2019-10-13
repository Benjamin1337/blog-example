@extends ('layouts.app')
@section('content')

    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h2 class="my-4">
                    <small>Результаты поиска</small>
                </h2>

                <!-- Blog Post -->
                @foreach($articles as $article)
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="card-title">{!! $article->title !!}</h2>
                            <p class="card-text">{!! $article->short_text !!}</p>
                            <p class="card-text">
{{--                                @foreach($article->tags as $tags )--}}

{{--                                    <a href="/tags/{{$tags->id}}" style="height: 100%;" class="d-inline-block badge badge-secondary"><span class="m-1">{{ $tags->name }}</span></a>--}}
{{--                                @endforeach--}}
                            </p>
                            <a href="{!! route('blog.show', [
                                    'id' => $article->article_id,
                                    'slug' => str_slug($article->title),
                                    ]) !!}" class="btn btn-primary">Читать полностью &rarr;</a>
                        </div>
                        <div class="card-footer text-muted">
                            Опубликовал <a href="/user/{{$article->user_id}}">{{_getUser($article->user_id)->user_name}}</a>
                            в {!! $article->created_at !!}
                        </div>
                    </div>
            @endforeach

            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Search Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Search</h5>
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

            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

@stop