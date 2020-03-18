<?php

namespace App\Repository\Wiki;

use App\Model\Wiki\WikiArticleSommaire;

class WikiArticleSommaireRepository
{
    /**
     * @var WikiArticleSommaire
     */
    private $wikiArticleSommaire;

    /**
     * WikiArticleSommaireRepository constructor.
     * @param WikiArticleSommaire $wikiArticleSommaire
     */

    public function __construct(WikiArticleSommaire $wikiArticleSommaire)
    {
        $this->wikiArticleSommaire = $wikiArticleSommaire;
    }

    public function create($article_id, $title)
    {
        return $this->wikiArticleSommaire->newQuery()
            ->create([
                "wiki_id" => $article_id,
                "title" => $title
            ]);
    }

    public function getForArticle($article_id)
    {
        return $this->wikiArticleSommaire->newQuery()
            ->where('wiki_id', $article_id)
            ->get();
    }

    public function delete($sommaire_id)
    {
        return $this->wikiArticleSommaire->newQuery()
            ->find($sommaire_id)
            ->delete();
    }

}

