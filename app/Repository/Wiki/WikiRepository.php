<?php
namespace App\Repository\Wiki;

use App\Model\Wiki\Wiki;

class WikiRepository
{
    /**
     * @var Wiki
     */
    private $wiki;

    /**
     * WikiRepository constructor.
     * @param Wiki $wiki
     */

    public function __construct(Wiki $wiki)
    {
        $this->wiki = $wiki;
    }

    public function getFromSub($subcategory_id)
    {
        return $this->wiki->newQuery()
            ->where('wiki_sub_category_id', $subcategory_id)
            ->where('published', 1)
            ->orderBy('published_at', 'desc')
            ->get();
    }

    public function get($wiki_id)
    {
        return $this->wiki->newQuery()
            ->find($wiki_id)
            ->load('category', 'subcategory');
    }

    public function search($get)
    {
        return $this->wiki->newQuery()
            ->where('title', 'like', '%'.$get.'%')
            ->limit(10)
            ->get();
    }

    public function all()
    {
        return $this->wiki->newQuery()
            ->where('published', 1)
            ->orderByDesc('published_at')
            ->get();
    }

    public function allLimit($limit = 5)
    {
        return $this->wiki->newQuery()
            ->where('published', 1)
            ->orderByDesc('published_at')
            ->limit($limit)
            ->get();
    }

    public function getFromCategory($category_id)
    {
        return $this->wiki->newQuery()
            ->where('wiki_category_id', $category_id)
            ->where('published', 1)
            ->orderBy('published_at', 'desc')
            ->get();
    }

    public function allWL($limit = null)
    {
        return $this->wiki->newQuery()
            ->limit($limit)
            ->get();
    }

    public function store($category_id, $subcategory_id, $title)
    {
        return $this->wiki->newQuery()
            ->create([
                "wiki_category_id" => $category_id,
                "wiki_sub_category_id" => $subcategory_id,
                "title" => $title,
                "content" => "No Content"
            ]);
    }

    public function delete($article_id)
    {
        return $this->wiki->newQuery()
            ->find($article_id)
            ->delete();
    }

    public function updateInfo($article_id, $title, int $published, $published_at)
    {
        return $this->wiki->newQuery()
            ->find($article_id)
            ->update([
                "title" => $title,
                "published" => $published,
                "published_at" => $published_at
            ]);
    }

    public function publish($article_id)
    {
        return $this->wiki->newQuery()
            ->find($article_id)
            ->update([
                "published" => 1,
                "published_at" => now()
            ]);
    }

    public function unpublish($article_id)
    {
        return $this->wiki->newQuery()
            ->find($article_id)
            ->update([
                "published" => 0
            ]);
    }

}

