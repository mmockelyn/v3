<?php
namespace App\Repository\Blog;

use App\Model\Blog\Blog;

class BlogRepository
{
    /**
     * @var Blog
     */
    private $blog;

    /**
     * BlogRepository constructor.
     * @param Blog $blog
     */

    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    public function allWithPublish()
    {
        return $this->blog->newQuery()
            ->published()
            ->orderAsc()
            ->get()
            ->load('comments', 'category', 'tags');
    }

    public function allWithLimit($lenght)
    {
        return $this->blog->newQuery()
            ->published()
            ->orderAsc()
            ->limit($lenght)
            ->get()
            ->load('comments', 'category', 'tags');
    }
    public function all()
    {
        return $this->blog->newQuery();
    }

    public function allPaginate()
    {
        return $this->all()->paginate(10);
    }

    public function getBySlug($slug)
    {
        return $this->blog->newQuery()
            ->where('slug', $slug)
            ->first()
            ->load('comments', 'category', 'tags');
    }

    public function get($article_id)
    {
        return $this->blog->newQuery()
            ->find($article_id)
            ->load('comments', 'category', 'tags');
    }

    public function search($get)
    {
        return $this->blog->newQuery()
            ->where('title', 'like', '%'.$get.'%')
            ->limit(10)
            ->get();
    }


}

