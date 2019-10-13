@extends('layouts.admin')

@section('content')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h1>Редактировать статью</h1>
        <br>
        <form method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <img class="card-img-top" style="max-width: 730px" src="{{ asset('/storage/' . $article->image['file_name']) }}" alt="Card image cap">
            <p>Выбор изображения поста

                <input type="file" name="image" id="image" class="custom-file"></p>
            <p>Выбор категорий<br><select name="categories[]" class="form-control" multiple>
                    @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    @if(in_array($category->id, $arrCategories)) selected @endif
                            >{{ $category->title }}</option>

                    @endforeach
                </select>
            </p>
            <p>Выбор тегов<br><select name="tags[]" id="tags" class="form-control" multiple>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" @if(in_array($tag->id, $arrTags)) selected @endif>{{ $tag->name }}</option>

                    @endforeach
                </select>
            </p>
            <p>Название статьи:<br><input type="text" name="title" value="{{ $article->title }}" class="form-control" required></p>
{{--            <p>Автор<br><input type="text" name="author" value="{{ $article->author }}" class="form-control" required></p>--}}
            <p>Текст для предпросмотра<br><textarea name="short_text" class="form-control">{!! $article->short_text !!}</textarea> </p>
            <p>Текст<br><textarea name="description" id="editor" class="form-control">{!! $article->full_text !!}</textarea> </p>
            <button type="submit" class="btn btn-success">Редактировать</button>
        </form>
    </main>
    <script src="{{asset('/js/snote.js')}}"></script>
@stop