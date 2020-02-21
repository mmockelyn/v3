<?php
namespace App\Repository\Wiki;

use App\Model\Wiki\WikiSubCategory;

class WikiSubCategoryRepository
{
    /**
     * @var WikiSubCategory
     */
    private $wikiSubCategory;

    /**
     * WikiSubCategoryRepository constructor.
     * @param WikiSubCategory $wikiSubCategory
     */

    public function __construct(WikiSubCategory $wikiSubCategory)
    {
        $this->wikiSubCategory = $wikiSubCategory;
    }

    public function get($subcategory_id)
    {
        return $this->wikiSubCategory->newQuery()
            ->find($subcategory_id);
    }

}

