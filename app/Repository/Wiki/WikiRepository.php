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

}

