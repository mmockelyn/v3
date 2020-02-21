<?php
namespace App\Repository\Wiki;

use App\Model\Wiki\WikiCategory;

class WikiCategoryRepository
{
    /**
     * @var WikiCategory
     */
    private $wikiCategory;

    /**
     * WikiCategoryRepository constructor.
     * @param WikiCategory $wikiCategory
     */

    public function __construct(WikiCategory $wikiCategory)
    {
        $this->wikiCategory = $wikiCategory;
    }

    public function all()
    {
        return $this->wikiCategory->newQuery()
            ->get();
    }

    public function get($category_id)
    {
        return $this->wikiCategory->newQuery()
            ->find($category_id)
            ->load('subcategories');
    }

}

