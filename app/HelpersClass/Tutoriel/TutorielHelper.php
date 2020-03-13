<?php

namespace App\HelpersClass\Tutoriel;

use App\Model\Tutoriel\Tutoriel;
use App\Model\Tutoriel\TutorielComment;
use App\Model\Tutoriel\TutorielSubCategory;

class TutorielHelper
{
    public static function stringDifficult($diff)
    {
        switch ($diff) {
            case 0:
                return 'facile';
            case 1:
                return 'intermediaire';
            case 2:
                return 'difficile';
            default:
                return null;
        }
    }

    public static function stringDifficultLabel($diff)
    {
        switch ($diff) {
            case 0:
                return 'success';
            case 1:
                return 'warning';
            case 2:
                return 'danger';
            default:
                return null;
        }
    }

    public static function countTutoriel()
    {
        $tutoriel = new Tutoriel;
        return $tutoriel->newQuery()
            ->where('published', 1)
            ->count();
    }

    public static function countAllTutoriel()
    {
        $tutoriel = new Tutoriel;
        return $tutoriel->newQuery()
            ->count();
    }

    public static function countTimeAllTutoriel()
    {
        $tutoriel = new Tutoriel;
        $time = $tutoriel->newQuery()
            ->sum('time');
        return round($time / 60, 0, PHP_ROUND_HALF_EVEN);
    }

    public static function countCommentFromTutoriel($tutoriel_id)
    {
        $comments = new TutorielComment;

        return $comments->newQuery()
            ->where('published', 1)
            ->where('tutoriel_id', $tutoriel_id)
            ->count();
    }

    public static function getNameOfSubcategory($subcategory)
    {
        $category = new TutorielSubCategory;
        $data = $category->newQuery()->find($subcategory)->toArray();

        return $data['name'];
    }

    public static function countTimeTutorielFromCategory($subcategory)
    {
        $tutoriel = new Tutoriel;
        $time = $tutoriel->newQuery()
            ->where('tutoriel_sub_category_id', $subcategory)
            ->sum('time');
        return round($time / 60, 0, PHP_ROUND_HALF_EVEN);
    }

    public static function getInfoTutoriel($tutoriel_id, $field = null)
    {
        $asset = new Tutoriel;
        $data = $asset->newQuery()->find($tutoriel_id);

        return $data->$field;
    }

    public static function getImagesBackground($tutoriel_id)
    {
        if (file_exists('/storage/tutoriel/background_' . $tutoriel_id . '.png')) {
            return '/storage/tutoriel/background_' . $tutoriel_id . '.png';
        } else {
            return '/storage/tutoriel/background_tutoriel.png';
        }
    }

    public static function getTagsFromTutoriel($tutoriel_id)
    {
        $tutoriel = new Tutoriel;

        $data = $tutoriel->newQuery()->find($tutoriel_id)->load('tags')->toArray();

        $tab = [];

        foreach ($data['tags'] as $datum) {
            $tab[] = $datum['name'];
        }

        return $tab;
    }

    public static function getTutorielComments()
    {
        $comment = new TutorielComment;
        $data = $comment->newQuery()->where('published', 1)->get();
        return $data;
    }

    public static function getLatestCommentAutor($article_id)
    {
        $comment = new TutorielComment;
        $data = $comment->newQuery()->where('tutoriel_id', $article_id)->where('published', 1)->get()->last();
        return $data->user->name;
    }

    public static function getLatestCommentDate($article_id)
    {
        $comment = new TutorielComment;
        $data = $comment->newQuery()->where('tutoriel_id', $article_id)->where('published', 1)->get()->last();
        return $data->published_at;
    }

    public static function stateTutoriel($published)
    {
        if ($published == 2) {
            return 'kt-font-danger';
        } elseif ($published == 1) {
            return 'kt-font-warning';
        } else {
            return 'kt-font-success';
        }
    }

    public static function countComment()
    {
        $comments = new TutorielComment;

        return $comments->newQuery()
            ->count();
    }

    public static function countAllTutorielFromCategory($id)
    {
        $tutoriel = new Tutoriel();

        return $tutoriel->newQuery()
            ->where('tutoriel_category_id', $id)
            ->count();
    }

    public static function countAllTutorielFromSubCategory($id)
    {
        $tutoriel = new Tutoriel();

        return $tutoriel->newQuery()
            ->where('tutoriel_sub_category_id', $id)
            ->count();
    }
}

