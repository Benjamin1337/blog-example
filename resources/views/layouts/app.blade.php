
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Beta blog</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.10.6/jquery.typeahead.min.js" integrity="sha256-W+Cxk9exgjON2p73M4RcoKvCpQUZ+IjXhEzZk6rlg9M=" crossorigin="anonymous"></script>

    <!-- Bootstrap core CSS -->
    <link href="{{ URL('blog/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Bootstrap core JavaScript -->
    <script src="{{ URL('blog/vendor/jquery/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL('blog/vendor/bootstrap/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL('blog/vendor/typeahead/jquery.typeahead.js') }}" type="text/javascript"></script>

    <!-- Custom styles for this template -->
    <link href="{{ URL('blog/css/blog.css') }}" rel="stylesheet">
    <link href="{{ URL('blog/css/blog-home.css') }}" rel="stylesheet">
    <link href="{{ URL('blog/css/blog-post.css') }}" rel="stylesheet">


</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">Beta Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Свежее
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Юмор</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Истории</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Блог</a>
                </li>
                @if(\Auth::check())
                <li class="nav-item ">
                    <a class="nav-link text-white" href="/my/account">{{\Auth::user()->user_name}}</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-white" href="/logout">Выйти</a>
                </li>
                    @else
                <li class="nav-item ">
                    <a class="nav-link text-white" href="/login">Вход</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->

@yield('content')


<!-- Footer -->
<footer class="py-4 bg-dark d-inline-flex">
    @if(\Auth::check())
        @if (\Auth::user()->adminPermissions)
        <div class="container">
            <p class="m-0 text-left text-white"><a class="text-white" href="/admin">Администраторский раздел</a> </p>
        </div>
        @endif
    @endif
    <div class="container">
        <p class="m-0 text-right text-white">Copyright &copy; Beta Blog 2019</p>
    </div>
    <!-- /.container -->
</footer>

<script>
    var route = "{{url('/autocomplete')}}";
    $('search').typeahead({
        source: function (term,process) {
            return $.get(route, {term:term}, function (data) {
                return process(data);
            })
        }
    })
</script>


</body>


</html>