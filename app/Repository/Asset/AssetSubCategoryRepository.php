<?php
namespace App\Repository\Asset;

use App\Model\Asset\AssetSubCategory;

class AssetSubCategoryRepository
{
    /**
     * @var AssetSubCategory
     */
    private $assetSubCategory;

    /**
     * AssetSubCategoryRepository constructor.
     * @param AssetSubCategory $assetSubCategory
     */

    public function __construct(AssetSubCategory $assetSubCategory)
    {
        $this->assetSubCategory = $assetSubCategory;
    }

    public function get($subcategory_id)
    {
        return $this->assetSubCategory->newQuery()
            ->find($subcategory_id);
    }

}

