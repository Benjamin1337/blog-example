@extends ('layouts.app')
@section('content')

    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h2 class="my-4">
                    <small>Все статьи</small>
                </h2>

                <!-- Blog Post -->
                @foreach($articles as $article)
                <div class="card mb-4">
                    <img class="card-img-top" style="max-width: 730px" src="{{ asset('/storage/' . $article->image['file_name']) }}" alt="Card image cap">
                    <div class="card-body">
                        <h2 class="card-title">{!! $article->title !!}</h2>
                        <p class="card-text">{!! $article->short_text !!}</p>
                        <p class="card-text">
                            @foreach($article->tags as $tags )

                                <a href="/tags/{{$tags->id}}" style="height: 100%;" class="d-inline-block badge badge-secondary"><span class="m-1">{{ $tags->name }}</span></a>
                            @endforeach
                        </p>
                        <a href="{!! route('blog.show', [
                                    'id' => $article->article_id,
                                    'slug' => str_slug($article->title),
                                    ]) !!}" class="btn btn-primary">Читать полностью &rarr;</a>

                        <div class="card-interaction" data-post-id="{{ $article->article_id }}">
                            @if(Auth::check())
                                <a href="" class="badge like">{{ Auth::user()->like()->where('article_id', $article->article_id)->first() ? Auth::user()->like()->where('article_id', $article->article_id)->first()->like == 1 ? 'Вам понравилось' : 'Мне нравится' : 'Мне нравится' }}</a> |
                                <a href="" class="badge like">{{ Auth::user()->like()->where('article_id', $article->article_id)->first() ? Auth::user()->like()->where('article_id', $article->article_id)->first()->like == 0 ? 'Вам не понравилось' : 'Мне не нравится' : 'Мне не нравится' }}</a>

                            @endif
                                <p class="badge like-count">Понравилось: {{ $article->totalLikes->count()}}</p>
                                <p class="badge view-count">Просмотры: {{ $article->view_count}}</p>
                        </div>

                    </div>



                    <div class="card-footer text-muted">
                        Опубликовал <a href="/user/{{$article->user['user_id']}}">{{$article->user['user_name']}}</a>
                        в {!! $article->created_at->format('H:i - d/m/Y') !!}
                    </div>
                </div>
                @endforeach


                <!-- Pagination -->
                <ul class="pagination justify-content-center mb-4">
                    {{ $articles->links() }}
                </ul>

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


            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
    <script src="{{asset('/js/like.js')}}"></script>
    <script type="text/javascript">
        var token = '{{csrf_token()}}';
        var urlLike = '{{ route ('like') }}';
    </script>


@stop