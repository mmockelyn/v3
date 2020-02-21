<?php
namespace App\Repository\Tutoriel;

use App\Model\Tutoriel\Tutoriel;

class TutorielRepository
{
    /**
     * @var Tutoriel
     */
    private $tutoriel;

    /**
     * TutorielRepository constructor.
     * @param Tutoriel $tutoriel
     */

    public function __construct(Tutoriel $tutoriel)
    {
        $this->tutoriel = $tutoriel;
    }

    public function allWithLimit($limit)
    {
        return $this->tutoriel->newQuery()
            ->where('published', 1)
            ->orderBy('published_at', 'asc')
            ->limit($limit)
            ->get()
            ->load('category', 'subcategory', 'tags', 'comments', 'requis', 'sources', 'technologies');
    }

    public function get($tutoriel_id)
    {
        return $this->tutoriel->newQuery()
            ->find($tutoriel_id)
            ->load('tags', 'category', 'subcategory', 'comments', 'requis', 'sources', 'technologies');
    }

    public function allForPublish()
    {
        return $this->tutoriel->newQuery()
            ->where('published', 2)
            ->get()
            ->load('category', 'subcategory', 'tags', 'comments', 'requis', 'sources', 'technologies');
    }

    public function listForCategory($subcategory_id)
    {
        return $this->tutoriel->newQuery()
            ->where('tutoriel_sub_category_id', $subcategory_id)
            ->where('published', 1)
            ->orWhere('published', 2)
            ->orderBy('published_at', 'asc')
            ->get()
            ->load('category', 'subcategory', 'tags', 'comments', 'requis', 'sources', 'technologies');
    }

    public function search($get)
    {
        return $this->tutoriel->newQuery()
            ->where('title', 'like', '%'.$get.'%')
            ->limit(10)
            ->get();
    }

}

