<?php
namespace App\Repository\Asset;

use App\Model\Asset\Asset;
use Illuminate\Support\Carbon;

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

    public function allWithLimit($limit = 100)
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

    public function find($asset_id)
    {
        return $this->asset->newQuery()
            ->find($asset_id);
    }

    public function search($get)
    {
        return $this->asset->newQuery()
            ->where('designation', 'like', '%' . $get . '%')
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

    public function all($limit = null)
    {
        return $this->asset->newQuery()
            ->limit($limit)
            ->get();
    }

    public function create($category_id, $subcategory_id, $designation, $short_description, $uuid)
    {
        return $this->asset->newQuery()
            ->create([
                "asset_category_id" => $category_id,
                "asset_sub_category_id" => $subcategory_id,
                "designation" => $designation,
                "short_description" => $short_description,
                "uuid" => $uuid
            ]);
    }

    public function updateState($asset_id, int $int)
    {
        if ($int == 1) {
            $published_at = now();
        } else {
            $published_at = null;
        }
        $this->find($asset_id)->update([
            "published" => $int,
            "published_at" => $published_at
        ]);
    }

    public function updateLinkDownload($asset_id, string $string)
    {
        return $this->find($asset_id)
            ->update([
                "downloadLink" => $string
            ]);
    }

    public function updatePrice($asset_id, $price)
    {
        return $this->find($asset_id)->update([
            "price" => $price
        ]);
    }

    public function updateInfo($asset_id, $designation, $kuid, int $published, ?Carbon $published_at, int $social, int $mesh, int $config, int $pricing, $short_description)
    {
        return $this->find($asset_id)
            ->update([
                "designation" => $designation,
                "kuid" => $kuid,
                "published" => $published,
                "published_at" => $published_at,
                "social" => $social,
                "mesh" => $mesh,
                "config" => $config,
                "pricing" => $pricing,
                "short_description" => $short_description
            ]);
    }

    public function updateDescription($asset_id, $description)
    {
        return $this->find($asset_id)
            ->update([
                "description" => $description
            ]);
    }

    public function delete($asset_id)
    {
        return $this->find($asset_id)
            ->delete();
    }

    public function getByCategory($subcategory_id)
    {
        return $this->asset->newQuery()
            ->where('published', 1)
            ->orderBy('published_at', 'asc')
            ->where('asset_sub_category_id', $subcategory_id)
            ->get();
    }

    public function getLatestAsset()
    {
        return $this->asset->newQuery()
            ->where('published', 1)
            ->orderBy('updated_at', 'desc')
            ->latest();
    }

}

