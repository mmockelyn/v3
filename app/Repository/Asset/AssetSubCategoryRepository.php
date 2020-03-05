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

    public function all($limit = null)
    {
        return $this->assetSubCategory->newQuery()
            ->limit($limit)
            ->get();
    }

    public function create($category_id, $name)
    {
        return $this->assetSubCategory->newQuery()
            ->create([
                "asset_category_id" => $category_id,
                "name" => $name
            ]);
    }

    public function delete($subcategory_id)
    {
        return $this->get($subcategory_id)->delete();
    }

}

