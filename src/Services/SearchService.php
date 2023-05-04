<?php

namespace App\Services;
use GuzzleHttp\Client as Client;

class SearchService
{
    public function GetVideo($search){
        $httpClient = new Client(['verify' => false]);

        $response = $httpClient->request('GET', 'https://youtube.googleapis.com/youtube/v3/search', [
            'query' => ['part' => 'snippet','maxResults' => 10,'q' => $search, 'key' => 'AIzaSyDLUGMUBXSauEtDH2tI-S0-2sKvfLXHBF8']
        ]);

        $array = [];

        $data = json_decode($response->getBody(), true);
        for ($i = 0; $i < 10 ; $i++){
            if (array_key_exists('videoId', $data['items'][$i]['id'])) {
                $arr['title'] = $data['items'][$i]['snippet']['title'];
                $arr['id'] = $data['items'][$i]['id']['videoId'];
                $array[] = $arr;
            }
            else{
                continue;
            }
        }
        return $array;

    }

}