@extends ('layouts.app')
@section('content')

    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h2 class="my-4">
                    <small>Secondary Text</small>
                </h2>

                <!-- Blog Post -->
                @foreach($articles as $article)
                    <div class="card mb-4">
                        <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
                        <div class="card-body">
                            <h2 class="card-title">{!! $article->title !!}</h2>
                            <p class="card-text">{!! $article->short_text !!}</p>
                            <p class="card-text">
{{--                                @foreach($article->tags as $tags )--}}

{{--                                    <a href="/tags/{{$tags->id}}" style="height: 100%;" class="d-inline-block badge badge-secondary"><span class="m-1">{{ $tags->name }}</span></a>--}}
{{--                                @endforeach--}}
                            </p>
                            <a href="{!! route('blog.show', [
                                    'id' => $article->id,
                                    'slug' => str_slug($article->title),
                                    ]) !!}" class="btn btn-primary">Читать полностью &rarr;</a>

                        </div>



                        <div class="card-footer text-muted">
                            Опубликовал <a href="#">{{$article->author}}</a>
{{--                            в {!! $article->created_at->format('H:i - d/m/Y') !!}--}}
                        </div>
                    </div>
            @endforeach


            <!-- Pagination -->
                <ul class="pagination justify-content-center mb-4">
                    <li class="page-item">
                        <a class="page-link" href="#">&larr; Older</a>
                    </li>
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Newer &rarr;</a>
                    </li>
                </ul>

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