<?php
namespace App\Repository\Asset;

use App\Model\Asset\AssetCompatibility;

class AssetCompatibilityRepository
{
    /**
     * @var AssetCompatibility
     */
    private $assetCompatibility;

    /**
     * AssetCompatibilityRepository constructor.
     * @param AssetCompatibility $assetCompatibility
     */

    public function __construct(AssetCompatibility $assetCompatibility)
    {
        $this->assetCompatibility = $assetCompatibility;
    }

    public function create($asset_id, $trainz_build_id, $state)
    {
        return $this->assetCompatibility->newQuery()
            ->create([
                "asset_id" => $asset_id,
                "trainz_build_id" => $trainz_build_id,
                "state" => $state
            ]);
    }

    public function allFormAsset($asset_id, $limit = null)
    {
        return $this->assetCompatibility->newQuery()
            ->where('asset_id', $asset_id)
            ->limit($limit)
            ->get();
    }

    public function delete($compatibility_id)
    {
        return $this->assetCompatibility->newQuery()
            ->find($compatibility_id)
            ->delete();
    }

    public function deleteForAsset($asset_id)
    {
        return $this->assetCompatibility->newQuery()
            ->where('asset_id', $asset_id)
            ->delete();
    }

}

