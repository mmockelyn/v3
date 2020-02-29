<?php
namespace App\Repository\Blog;

use App\Model\Blog\Blog;
use Illuminate\Support\Str;

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
            ->orderDesc()
            ->get()
            ->load('comments', 'category', 'tags');
    }

    public function allWithLimit($lenght)
    {
        return $this->blog->newQuery()
            ->published()
            ->orderDesc()
            ->limit($lenght)
            ->get()
            ->load('comments', 'category', 'tags');
    }
    public function all()
    {
        return $this->blog->newQuery();
    }

    public function list($sort = null, $query = null)
    {
        return $this->all()
            ->orderBy($sort['field'], $sort['sort'])
            ->where('title', 'like', '%'.$query.'%')
            ->get();
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

    public function listForLimit($int)
    {
        return $this->all()->limit($int)->get();
    }

    public function create($category_id, $title, $short_content)
    {
        return $this->blog->newQuery()
            ->create([
                "categorie_id" => $category_id,
                "title" => $title,
                "slug" => Str::slug($title),
                "short_content" => $short_content,
                "content" => "<i>".$short_content."</i>"
            ]);
    }

    public function delete($article_id)
    {
        return $this->blog->newQuery()
            ->find($article_id)
            ->delete();
    }

    public function publish($article_id)
    {
        return $this->blog->newQuery()
            ->find($article_id)
            ->update([
                "published" => 1,
                "published_at" => now()
            ]);
    }

    public function unpublish($article_id)
    {
        return $this->blog->newQuery()
            ->find($article_id)
            ->update([
                "published" => 0,
                "published_at" => null
            ]);
    }


}

