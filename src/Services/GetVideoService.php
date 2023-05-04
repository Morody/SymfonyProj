<?php

namespace App\Services;
use GuzzleHttp\Client as Client;


class GetVideoService
{
    public function GetVideo($url){
        $httpClient = new Client(['verify' => false]);

        $response = $httpClient->request('GET', 'https://youtube.googleapis.com/youtube/v3/videos', [
            'query' => ['part' => 'snippet', 'id' => $url, 'key' => 'AIzaSyDLUGMUBXSauEtDH2tI-S0-2sKvfLXHBF8']
        ]);

        $data = json_decode($response->getBody(), true);


        return $data['items'][0]['snippet']['title'];
    }
}