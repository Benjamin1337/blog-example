<?php

if (!function_exists('_getUser')) {
    function _getUser($user_id)
    {
        $objUser = \App\Entities\User::find($user_id);
        if(!$objUser) {
            return abort(404);
        }

        return $objUser;
    }
}

if (!function_exists('_getArticle')) {
    function _getArticle($article_id)
    {
        $objArticle = \App\Entities\Article::find($article_id);
        if(!$objArticle) {
            return abort(404);
        }

        return $objArticle;
    }
}

if (!function_exists('_getCategory')) {
    function _getCategory($category_id)
    {
        $objCategory = \App\Entities\Category::find($category_id);
        if(!$objCategory) {
            return abort(404);
        }

        return $objCategory;
    }
}
