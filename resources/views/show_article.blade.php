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
                <a href="#">{!! $article->author !!}</a>
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
            <img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">

            <hr>

            <!-- Post Content -->
            <p class="lead">{!! $article->short_text !!}</p>

            <p>{!! $article->full_text !!}</p>

           {{-- <blockquote class="blockquote">
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                <footer class="blockquote-footer">Someone famous in
                    <cite title="Source Title">Source Title</cite>
                </footer>
            </blockquote>--}}
            <hr>

            <!-- Comments Form -->
            @if(\Auth::check())
            <div class="card my-4">
                <h5 class="card-header">Оставте комментарий:</h5>
                <div class="card-body">

                    <form method="post" action="{!! route('comments.add') !!}">
                        {!! csrf_field() !!}
                        <input type="hidden" value="{{$article->id }}" name="article_id">
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
                        <h5 class="mt-0">{{_getUser($comment->user_id)->username}}
                        <small>{{$comment->created_at->format('H:i - d/m/Y')}}</small></h5>
                        {!! $comment->comment !!}
                    </div>
                </div>
            @endforeach


            {{--<!-- Comment with nested comments -->
            <div class="media mb-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                    <h5 class="mt-0">Commenter Name</h5>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

                    <div class="media mt-4">
                        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                        <div class="media-body">
                            <h5 class="mt-0">Commenter Name</h5>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>
                    </div>

                    <div class="media mt-4">
                        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                        <div class="media-body">
                            <h5 class="mt-0">Commenter Name</h5>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>
                    </div>

                </div>
            </div>--}}

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
            <div class="card my-4">
                <h5 class="card-header">Categories</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a href="#">Web Design</a>
                                </li>
                                <li>
                                    <a href="#">HTML</a>
                                </li>
                                <li>
                                    <a href="#">Freebies</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a href="#">JavaScript</a>
                                </li>
                                <li>
                                    <a href="#">CSS</a>
                                </li>
                                <li>
                                    <a href="#">Tutorials</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

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
</article>

@stop