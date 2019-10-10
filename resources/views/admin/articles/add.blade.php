@extends('layouts.admin')

@section('content')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h1>Добавить статью</h1>
        <br>
        <form method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input">
                    <label class="custom-file-label"></label>
                </div>
            </div>
            <p>Выбор категорий<br><select name="categories[]" class="form-control" multiple>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </p>
            <p>Выбор тегов<br><select name="tags[]" class="form-control" multiple>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </p>
            <p>Название статьи:<br><input type="text" name="title" class="form-control" required></p>
            <p>Автор<br><input type="text" name="author" class="form-control" required></p>
            <p>Текст для предпросмотра<br><textarea name="short_text" class="form-control"></textarea> </p>
            <p>Текст<br><textarea name="full_text" class="form-control"></textarea> </p>
            <button type="submit" class="btn btn-success">Добавить</button>
        </form>
    </main>
@stop