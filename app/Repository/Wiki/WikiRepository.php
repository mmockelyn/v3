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
            ->orderBy('published_at', 'asc')
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

}

