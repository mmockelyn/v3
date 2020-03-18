<?php

namespace App\HelpersClass\Wiki;

use App\Model\Wiki\Wiki;
use App\Model\Wiki\WikiArticleContent;

class WikiHelpers
{
    public static function countWikiFromCatgegory($sub_id)
    {
        $wiki = new Wiki;

        return $wiki->newQuery()->where('wiki_sub_category_id', $sub_id)->where('published', 1)->count();
    }

    public static function getContentFromSommaire($sommaire_id, $field)
    {
        $content = new WikiArticleContent();

        $data = $content->newQuery()->where('sommaire_id', $sommaire_id)->first();

        return $data->$field;
    }
}

