<?php

Route::get('/', 'ArticlesController@index');




//blog routes
Route::get('/article/{id}/{slug}', 'ArticlesController@showArticle')->where('id', '\d+')->name('blog.show');
Route::get('/tags/{id}', 'TagsController@index')->where('id', '\d+')->name('tag.show');
Route::get('/categories/{id}', 'CategoriesController@index')->where('id', '\d+')->name('category.show');
Route::get('/user/{id}', 'UsersController@index')->where('id', '\d+')->name('user.show');

/**
 * Поиск
 */

Route::get('/search', 'SearchController@index')->name('search');
Route::get('/autocomplete', 'SearchController@search');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'Auth\RegisterController@register');
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::get('/logout', 'Auth\LoginController@logout')->name('login');
    Route::post('/login', 'Auth\LoginController@login');


});





Route::group(['middleware' => 'auth'], function() {
    Route::get('/logout', function () {
        \Auth::logout();
        return redirect (route('login'));
    })->name('logout');
    Route::get('/my/account/', 'AccountController@index')->name('account');
    Route::post('/like', 'ArticlesController@likeArticle')->name('like');

    //admin
    Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function() {
        Route::get('/', 'Admin\AccountController@index')->name('admin');

        /**
         * Комметарии
         */

        Route::post('/comments/add', 'CommentsController@addComment')->name('comments.add');

        Route::get('/comments', 'Admin\CommentsController@index')->name('comments');
        Route::get('/comments/accepted/{id}', 'Admin\CommentsController@acceptComment')
            ->where('id','\d+')->name('comments.accepted');
        /**
         * Категории
         */

        Route::get('/categories', 'Admin\CategoriesController@index')->name('categories');
        Route::get('/categories/add', 'Admin\CategoriesController@addCategory')->name('categories.add');
        Route::post('/categories/add', 'Admin\CategoriesController@addRequestCategory');
        Route::get('/categories/edit/{id}', 'Admin\CategoriesController@editCategory')
            ->where('id', '\d+')
            ->name('categories.edit');
        Route::post('/categories/edit/{id}', 'Admin\CategoriesController@editRequestCategory')
            ->where('id', '\d+');
        Route::delete('/categories/delete', 'Admin\CategoriesController@deleteCategory')->name('categories.delete');

        /**
         * Статьи
         */

        Route::get('/articles', 'Admin\ArticlesController@index')->name('articles');
        Route::get('/articles/add', 'Admin\ArticlesController@addArticle')->name('articles.add');
        Route::post('/articles/add', 'Admin\ArticlesController@addRequestArticle')->name('add.request.article');
        Route::get('/articles/edit/{id}', 'Admin\ArticlesController@editArticle')->where('id', '\d+')->name('articles.edit');
        Route::post('/articles/edit/{id}', 'Admin\ArticlesController@editRequestArticle')->where('id', '\d+');
        Route::delete('/articles/delete', 'Admin\ArticlesController@deleteArticle')->name('articles.delete');
        Route::get('/articles/accepted/{id}', 'Admin\ArticlesController@acceptArticle')
            ->where('id','\d+')->name('articles.accepted');
        Route::get('/articles/decline/{id}', 'Admin\ArticlesController@declineArticle')
            ->where('id','\d+')->name('articles.decline');

//        Route::post('/images/upload/', 'Admin\ImageController@uploadImage')->name('image.upload');

        /**
         * Пользователи
         */

        Route::get('/users','Admin\UsersController@index')->name('users');


        /**
         * Тэги
         */

        Route::get('/tags', 'Admin\TagsController@index')->name('tags');
        Route::get('/tags/add', 'Admin\TagsController@addTag')->name('tags.add');
        Route::post('/tags/add', 'Admin\TagsController@addRequestTag');
        Route::get('/tags/edit{id}', 'Admin\TagsController@editTag')
            ->where('id', '\d+')
            ->name('tags.edit');
        Route::post('/tags/edit{id}', 'Admin\TagsController@editRequestTag')
            ->where('id', '\d+');
        Route::delete('/tags/delete', 'Admin\TagsController@deleteTags')->name('tags.delete');





    });
});