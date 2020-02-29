<?php
namespace App\Repository\Blog;

use App\Model\Blog\BlogTag;
use Illuminate\Support\Str;

class BlogTagRepository
{
    /**
     * @var BlogTag
     */
    private $blogTag;

    /**
     * BlogTagRepository constructor.
     * @param BlogTag $blogTag
     */

    public function __construct(BlogTag $blogTag)
    {
        $this->blogTag = $blogTag;
    }

    public function allFromArticle($article_id)
    {
        return $this->blogTag->newQuery()
            ->where('blog_id', $article_id)
            ->get();
    }

    public function delete($tag_id)
    {
        return $this->blogTag->newQuery()
            ->find($tag_id)
            ->delete();
    }

    public function create($article_id, $tag)
    {
        return $this->blogTag->newQuery()
            ->create([
                "blog_id" => $article_id,
                "name" => $tag,
                "slug" => Str::slug($tag)
            ]);
    }

}

