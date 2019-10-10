
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Dashboard Template · Bootstrap</title>

    <link rel="stylesheet" href="/css/dashboard.css">

    <!-- Bootstrap core CSS -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->

</head>
<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/">Beta Blog</a>
    <a class="col-sm-2 col-md-6 " href="#">{{--Панель управления--}}</a>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="#">Sign out</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{isset($current) && $current == 'categories' ? 'active' : ''}}" href="{!! route('categories') !!}">
                            <span data-feather="home"></span>
                            Категории <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{isset($current) && $current == 'articles' ? 'active' : ''}}" href="{!! route('articles') !!}">
                            <span data-feather="file"></span>
                            Статьи
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{isset($current) && $current == 'users' ? 'active' : ''}}" href="{!! route('users') !!}">
                            <span data-feather="file"></span>
                            Пользователи
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{isset($current) && $current == 'comments' ? 'active' : ''}}" href="{!! route('comments') !!}">
                            <span data-feather="file"></span>
                            Комментарии
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{isset($current) && $current == 'tags' ? 'active' : ''}}" href="{!! route('tags') !!}">
                            <span data-feather="file"></span>
                            Тэги
                        </a>
                    </li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Saved reports</span>
                    <a class="d-flex align-items-center text-muted" href="#">
                        <span data-feather="plus-circle"></span>
                    </a>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            Current month
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            Last quarter
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            Social engagement
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            Year-end sale
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        @yield('content')
    </div>
</div>
<script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script src="https://cdn.rawgit.com/alertifyjs/alertify.js/v1.0.10/dist/js/alertify.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>--}}
<script src="/js/dashboard.js"></script>



@yield('js')

@include('inc.messages')

</body>
</html>
