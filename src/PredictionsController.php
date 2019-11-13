<?php

use GuzzleHttp\Client;

class PredictionsController implements iPredictionsObtainer
{
  
    public function getPredictionsByCity(string &$city)
    {
        // Create a Guzzle Http Client
        $client = new Client();

        // Find the id of the city on metawheather
        $woeid = json_decode($client->get("https://www.metaweather.com/api/location/search/?query=$city")->getBody()->getContents(),
            true)[0]['woeid'];
        $city = $woeid;

        // Find the predictions for the city
        $results = json_decode($client->get("https://www.metaweather.com/api/location/$city")->getBody()->getContents(),
            true)['consolidated_weather'];
        return $results;

    }

}

?>