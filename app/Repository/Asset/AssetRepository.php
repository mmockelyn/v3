<?php
namespace App\Repository\Asset;

use App\Model\Asset\Asset;

class AssetRepository
{
    /**
     * @var Asset
     */
    private $asset;

    /**
     * AssetRepository constructor.
     * @param Asset $asset
     */

    public function __construct(Asset $asset)
    {
        $this->asset = $asset;
    }

    public function allWithLimit($limit)
    {
        return $this->asset->newQuery()
            ->where('published', 1)
            ->orderBy('published_at', 'asc')
            ->limit($limit)
            ->get()
            ->load('category', 'subcategory', 'tags', 'compatibilities');
    }

    public function getByCategoryPaginate($subcategory_id)
    {
        return $this->asset->newQuery()
            ->where('published', 1)
            ->orderBy('published_at', 'asc')
            ->where('asset_sub_category_id', $subcategory_id)
            ->paginate(15);
    }

    public function get($asset_id)
    {
        return $this->asset->newQuery()
            ->find($asset_id)->load('category', 'subcategory');
    }

    public function search($get)
    {
        return $this->asset->newQuery()
            ->where('designation', 'like', '%'.$get.'%')
            ->limit(10)
            ->get();
    }

    public function updateCountDownload($asset_id, $newCount)
    {
        $this->asset->newQuery()
            ->find($asset_id)
            ->update(["countDownload" => $newCount]);

        return null;
    }

}

