<?php

namespace App\Repository\Wiki;

use App\Model\Wiki\WikiArticleContent;

class WikiArticleContentRepository
{
    /**
     * @var WikiArticleContent
     */
    private $wikiArticleContent;

    /**
     * WikiArticleContentRepository constructor.
     * @param WikiArticleContent $wikiArticleContent
     */

    public function __construct(WikiArticleContent $wikiArticleContent)
    {
        $this->wikiArticleContent = $wikiArticleContent;
    }

    public function create($article_id, $id, $contents)
    {
        return $this->wikiArticleContent->newQuery()
            ->create([
                "wiki_id" => $article_id,
                "sommaire_id" => $id,
                "content" => $contents
            ]);
    }

    public function deleteBySommaire($sommaire_id)
    {
        return $this->wikiArticleContent->newQuery()
            ->where('sommaire_id', $sommaire_id)
            ->delete();
    }

}

