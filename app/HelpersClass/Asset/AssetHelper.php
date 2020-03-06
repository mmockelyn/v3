<?php

namespace App\HelpersClass\Asset;

use App\Model\Asset\Asset;
use App\Model\Asset\AssetCategory;
use App\Model\Asset\AssetSubCategory;

class AssetHelper
{
    public static function stateClassCompatibility($state)
    {
        switch ($state) {
            case 0:
                return 'danger';
            case 1:
                return 'warning';
            case 2:
                return 'success';
            default:
                return null;
        }
    }

    public static function listOfCategories($viewArray = false)
    {
        $categories = new AssetCategory;
        $datas = $categories->newQuery()->get()->toArray();
        $array = [];

        foreach ($datas as $data) {
            $array[] = $data['name'];
        }

        if ($viewArray == false) {
            return implode(',', $array);
        } else {
            return $array;
        }
    }

    public static function getSubcategory($subcategory_id, $field = null)
    {
        $category = new AssetSubCategory;
        $data = $category->newQuery()->find($subcategory_id);

        return $data->$field;
    }

    public static function countAssetFromCategory($subcategory_id)
    {
        $asset = new Asset;
        $data = $asset->newQuery()->where('asset_sub_category_id', $subcategory_id)->count();

        return $data;
    }

    public static function getInfoAsset($asset_id, $field = null)
    {
        $asset = new Asset;
        $data = $asset->newQuery()->find($asset_id);

        return $data->$field;
    }

    public static function getAssetTags($asset_id)
    {
        $asset = new Asset;
        $data = $asset->newQuery()->find($asset_id);

        $array = [];

        foreach ($data->tags as $tag) {
            $array[] = $tag->name;
        }

        return $array;
    }

    public static function countAssets()
    {
        $asset = new Asset;
        $data = $asset->newQuery()
            ->where('published', 1)
            ->count();

        return $data;
    }
}

