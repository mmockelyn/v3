<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 26/02/2020
 * Time: 14:19
 */

namespace App\Packages\Google\Youtube;


use App\Packages\Google\Google;

class Search extends Google
{
    public function __construct()
    {
        parent::__construct();
    }

    public function list($search){
        $service = new \Google_Service_YouTube($this->client);
        $params = [
            "channelId" => env("GOOGLE_YOUTUBE_CHANNEL_ID"),
            "q" => $search
        ];

        $response = $service->search->listSearch('id, snippet', $params);

        return $response;
    }


}
