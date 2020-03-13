<?php
namespace App\Repository\Tutoriel;

use App\Model\Tutoriel\Tutoriel;
use Illuminate\Support\Str;

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
            ->orderBy('published_at', 'desc')
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
            ->orderBy('published_at', 'desc')
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

    public function filterBy($sub_id, $filter)
    {
        switch ($filter) {
            case 'desc':
            case 'all':
                return $this->listForCategory($sub_id);
                break;
            case 'asc':
                return $this->tutoriel->newQuery()
                    ->where('tutoriel_sub_category_id', $sub_id)
                    ->where('published', 1)
                    ->orWhere('published', 2)
                    ->orderBy('published_at', 'desc')
                    ->get()
                    ->load('category', 'subcategory', 'tags', 'comments', 'requis', 'sources', 'technologies');

            default: return $this->listForCategory($sub_id);
        }
    }

    public function all()
    {
        return $this->tutoriel->newQuery()->get();
    }

    public function allWL($limit = null)
    {
        return $this->tutoriel->newQuery()->limit($limit)->get();
    }

    public function create($request)
    {
        return $this->tutoriel->newQuery()
            ->create([
                "tutoriel_category_id" => $request->category_id,
                "tutoriel_sub_category_id" => $request->subcategory_id,
                "user_id" => 1,
                "title" => $request->title,
                "slug" => Str::slug($request->title),
                "short_content" => $request->short_content
            ]);
    }

    public function delete($tutoriel_id)
    {
        return $this->tutoriel->newQuery()
            ->find($tutoriel_id)
            ->delete();
    }

    public function updateDescription($tutoriel_id, $contents)
    {
        return $this->tutoriel->newQuery()
            ->find($tutoriel_id)
            ->update([
                "content" => $contents
            ]);
    }

    public function updateInfo($tutoriel_id, $title, $short_content, int $published, int $source, int $premium, $published_at, int $demo, $linkDemo)
    {
        return $this->tutoriel->newQuery()
            ->find($tutoriel_id)
            ->update([
                "title" => $title,
                "short_content" => $short_content,
                "published" => $published,
                "source" => $source,
                "premium" => $premium,
                "published_at" => $published_at,
                "demo" => $demo,
                "linkDemo" => $linkDemo
            ]);
    }

    public function publishLater($tutoriel_id, $published_at)
    {
        return $this->tutoriel->newQuery()
            ->find($tutoriel_id)
            ->update([
                "published" => 2,
                "published_at" => $published_at
            ]);
    }

    public function publish($tutoriel_id)
    {
        return $this->tutoriel->newQuery()
            ->find($tutoriel_id)
            ->update([
                "published" => 1,
                "published_at" => now()
            ]);
    }

    public function unpublish($tutoriel_id)
    {
        return $this->tutoriel->newQuery()
            ->find($tutoriel_id)
            ->update([
                "published" => 0,
                "published_at" => null
            ]);
    }

}

