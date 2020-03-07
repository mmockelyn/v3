<?php

namespace App\Repository\Asset;

use App\Model\Asset\AssetTag;
use Illuminate\Support\Str;

class AssetTagRepository
{
    /**
     * @var AssetTag
     */
    private $assetTag;

    /**
     * AssetTagRepository constructor.
     * @param AssetTag $assetTag
     */

    public function __construct(AssetTag $assetTag)
    {
        $this->assetTag = $assetTag;
    }

    public function create($asset_id, $tag)
    {
        return $this->assetTag->newQuery()
            ->create([
                "asset_id" => $asset_id,
                "name" => $tag,
                "slug" => Str::slug($tag)
            ]);
    }

    public function allFormAsset($asset_id, $limit = null)
    {
        return $this->assetTag->newQuery()
            ->where('asset_id', $asset_id)
            ->limit($limit)
            ->get();
    }

    public function delete($tag_id)
    {
        return $this->assetTag->newQuery()
            ->find($tag_id)
            ->delete();
    }

}

