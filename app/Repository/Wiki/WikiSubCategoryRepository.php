<?php
namespace App\Repository\Wiki;

use App\HelpersClass\Generator;
use App\Model\Wiki\WikiSubCategory;
use Illuminate\Support\Str;

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

    public function all()
    {
        return $this->wikiSubCategory->newQuery()
            ->get();
    }

    public function create($category_id, $name, $description, $icon)
    {
        return $this->wikiSubCategory->newQuery()
            ->create([
                "wiki_category_id" => $category_id,
                "name" => $name,
                "description" => $description,
                "short" => Str::slug($name),
                "icon" => $icon
            ]);
    }

    public function delete($subcategory_id)
    {
        $this->wikiSubCategory->newQuery()
            ->find($subcategory_id)
            ->delete();

        return null;
    }

    public function allByCategory($category_id)
    {
        return $this->wikiSubCategory->newQuery()
            ->where('wiki_category_id', $category_id)
            ->get();
    }

}

