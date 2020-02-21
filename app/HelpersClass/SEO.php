<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 29/01/2020
 * Time: 12:58
 */

namespace App\HelpersClass;


use App\HelpersClass\Asset\AssetHelper;
use App\HelpersClass\Tutoriel\TutorielHelper;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class SEO
{
    /**
     * @param array $data [title,description,route]
     */
    public static function generate(array $data)
    {

        SEOMeta::setTitle($data['title']);
        SEOMeta::setDescription($data['description']);
        SEOMeta::setCanonical($data['route']);
        if(array_key_exists('tag', $data)){
            SEOMeta::setKeywords($data['tag']);
        }

        SEOMeta::generate();

        OpenGraph::setTitle($data['title']);
        OpenGraph::setDescription($data['description']);
        OpenGraph::setUrl($data['route']);
        if(array_key_exists('tag', $data)){
            OpenGraph::addProperty('tags', $data['tag']);
        }
        if(array_key_exists('image', $data)){
            OpenGraph::addImage($data['image']);
        }
        if(array_key_exists('images', $data)){
            OpenGraph::addImages($data['images']);
        }

        OpenGraph::generate();

        TwitterCard::setTitle($data['title']);
        TwitterCard::setSite('@trainznation');
        if(array_key_exists('tag', $data)){
            TwitterCard::addValue('tags', $data['tag']);
        }
        if(array_key_exists('image', $data)){
            TwitterCard::addImage($data['image']);
        }

        TwitterCard::generate();
    }
}
