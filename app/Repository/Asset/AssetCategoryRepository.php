<?php
namespace App\Repository\Asset;

use App\Model\Asset\AssetCategory;

class AssetCategoryRepository
{
    /**
     * @var AssetCategory
     */
    private $assetCategory;

    /**
     * AssetCategoryRepository constructor.
     * @param AssetCategory $assetCategory
     */

    public function __construct(AssetCategory $assetCategory)
    {
        $this->assetCategory = $assetCategory;
    }

    public function all($limit)
    {
        return $this->assetCategory->newQuery()
            ->limit($limit)
            ->get();
    }

    public function get($category_id)
    {
        return $this->assetCategory->newQuery()
            ->find($category_id)
            ->load('subcategories');
    }

    public function delete($category_id)
    {
        return $this->assetCategory->newQuery()
            ->find($category_id)
            ->delete();
    }

}

