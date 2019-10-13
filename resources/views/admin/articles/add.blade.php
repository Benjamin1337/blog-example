@extends('layouts.admin')

@section('content')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h1>Добавить статью</h1>
        <br>


        <form method="post" action="{!! route('add.request.article') !!}" enctype="multipart/form-data">
            {!! csrf_field() !!}

            <div class="input-group">
                <div class="custom-file">
                    <p>Выбор изображения поста
                        <label class="custom-file-label"></label>
                        <input type="file" name="image" id="image" class="custom-file-input"></p>
                </div>
            </div>

            <div class="image-preview"><img src="" ></div>

            <p>Выбор категорий<br><select name="categories[]" id="categories" class="form-control" multiple>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </p>
            <p>Выбор тегов<br><select name="tags[]" id="tags" class="form-control" multiple>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </p>
            <p>Название статьи:<br><input type="text" id="title" name="title" class="form-control" required></p>
            {{--<p>Автор<br><input type="text" name="author" id="author" class="form-control" required></p>--}}
            <p>Текст для предпросмотра<br><textarea name="short_text" id="short_text" class="form-control"></textarea> </p>
            <p>Текст<br><textarea name="description" id="editor" class="form-control"></textarea> </p>
            <button id="submit_all" class="btn btn-success">Добавить</button>
        </form>
    </main>




        <script src="{{asset('/js/like.js')}}"></script>


        {{--$('input:file').change(--}}
        {{--    function(e) {--}}
        {{--        $('.custom-file-label').text(e.target.files[0].name);--}}

        {{--    });--}}

        {{--$('#submit_all').click (function (e) {--}}
        {{--    e.preventDefault();--}}

        {{--    var formData = ({--}}
        {{--        'title' : $('#title').val(),--}}
        {{--        'author': $('#author').val(),--}}
        {{--        'short_text': $('#short_text').val(),--}}
        {{--        'full_text': $('#full_text').val(),--}}
        {{--        'tags': $('#tags').val(),--}}
        {{--        'categories': $('#categories').val(),--}}
        {{--        'image': $('#image').val(),--}}
        {{--    });--}}

        {{--    console.log(formData);--}}
        {{--    $.ajax({--}}
        {{--        type: "POST",--}}
        {{--        processData: false,--}}
        {{--        contentType: false,--}}
        {{--        cache: false,--}}
        {{--        url: "{!! route('add.request.article') !!}",--}}
        {{--        data: formDatas,--}}
        {{--        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},--}}
        {{--        success: function(data) {--}}
        {{--        console.log(data)--}}
        {{--            alertify.alert(" Успешно загружено ");--}}
        {{--            alertify.success("{!! session()->get('success')  !!}");--}}
        {{--            // location.reload();--}}
        {{--        },--}}
        {{--        error: function (error) {--}}
        {{--            console.log(error);--}}
        {{--            alertify.alert(" Ошибка ");--}}
        {{--            alertify.error("{!! session()->get('error')  !!}");--}}
        {{--        },--}}
        {{--        complete: function (data) {--}}
        {{--            console.log(data);--}}

        {{--        }--}}
        {{--    })--}}

        {{--});--}}
    <script src="{{asset('/js/snote.js')}}"></script>
@stop