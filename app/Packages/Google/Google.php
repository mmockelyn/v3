<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 26/02/2020
 * Time: 14:00
 */

namespace App\Packages\Google;


class Google
{
    public $client;

    public function __construct()
    {
        $this->client = new \Google_Client();
        $this->client->setApplicationName(env("APP_NAME"));
        $this->client->setAuthConfig(public_path('client_google.json'));
        $this->client->setAccessType('offline');
        $this->client->addScope([
            'https://www.googleapis.com/auth/youtube.force-ssl'
        ]);

        if($this->client->getAccessToken() == null) {
            $authUri = $this->client->createAuthUrl();
            return redirect()->away($authUri);
        }
    }




}
