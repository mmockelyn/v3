<?php
namespace App\Repository\Blog;

use App\Model\Blog\BlogCategory;

class BlogCategoryRepository
{
    /**
     * @var BlogCategory
     */
    private $blogCategory;

    /**
     * BlogCategoryRepository constructor.
     * @param BlogCategory $blogCategory
     */

    public function __construct(BlogCategory $blogCategory)
    {
        $this->blogCategory = $blogCategory;
    }

    public function all()
    {
        return $this->blogCategory->newQuery()
            ->get();
    }

    public function delete($category_id)
    {
        return $this->blogCategory->newQuery()
            ->find($category_id)
            ->delete();
    }

    public function create($name)
    {
        return $this->blogCategory->newQuery()
            ->create([
                "name" => $name
            ]);
    }

}

