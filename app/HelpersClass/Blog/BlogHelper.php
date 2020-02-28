<?php
namespace App\HelpersClass\Blog;

use App\Model\Blog\Blog;
use App\Model\Blog\BlogComment;

class BlogHelper
{
    public static function getArticle($slug, $field = null) {
        $blog = new Blog();
        if($field == null) {
            return $blog->newQuery()->where('slug', $slug)->first();
        }else{
            $data = $blog->newQuery()->where('slug', $slug)->first();
            return $data->$field;
        }
    }

    public static function getArticleTags($slug) {
        $blog = new Blog();

        $data = $blog->newQuery()->where('slug', $slug)->first()->load('tags')->toArray();

        $tab = [];

        foreach ($data['tags'] as $datum) {
            $tab[] = $datum['name'];
        }

        return $tab;
    }

    public static function countCommentWithArticle($article_id)
    {
        $blog = new BlogComment();
        return $blog->newQuery()->where('blog_id', $article_id)->count();
    }

    public static function getLatestCommentAutor($article_id)
    {
        $comment = new BlogComment();
        $data = $comment->newQuery()->where('blog_id', $article_id)->where('state', 1)->get()->last();
        return $data->user->name;
    }

    public static function getLatestCommentDate($article_id)
    {
        $comment = new BlogComment();
        $data = $comment->newQuery()->where('blog_id', $article_id)->where('state', 1)->get()->last();
        return $data->updated_at;
    }

    public static function countArticle()
    {
        $blog = new Blog();
        return $blog->newQuery()->where('published', 1)->get()->count();
    }

    public static function countCommentaires()
    {
        $comment = new BlogComment();
        $countComment = $comment->newQuery()->where('state', 1)->get()->count();

        return $countComment;
    }

    public static function moyCommentArticle()
    {
        $comment = new BlogComment();
        $blog = new Blog();

        $countArticle = $blog->newQuery()->where('published', 1)->get()->count();
        $countComment = $comment->newQuery()->where('state', 1)->get()->count();

        return round($countComment/$countArticle, 0);
    }

    public static function publishArticle($state)
    {
        if($state == 0){return 'kt-font-danger';}else{return 'kt-font-success';}
    }
}

