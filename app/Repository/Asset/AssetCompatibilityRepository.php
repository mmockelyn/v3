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

}

