<?php

namespace App\HelpersClass\Wiki;

use App\Model\Wiki\Wiki;

class WikiHelpers
{
    public static function countWikiFromCatgegory($sub_id)
    {
        $wiki = new Wiki;

        return $wiki->newQuery()->where('wiki_sub_category_id', $sub_id)->where('published', 1)->count();
    }
}

