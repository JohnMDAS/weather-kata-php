<?php

use GuzzleHttp\Client;

class PredictionsController implements iPredictionsObtainer
{
  
    public function getPredictionsByCity(City &$city)
    {
        // Create a Guzzle Http Client
        $client = new Client();
        $cityName = $city -> getName();
        // Find the id of the city on metawheather
        $woeid = json_decode($client->get("https://www.metaweather.com/api/location/search/?query=$cityName")->getBody()->getContents(),
            true)[0]['woeid'];
        $city -> setId($woeid);

        $cityId = $city -> getCityId();
        // Find the predictions for the city
        $results = json_decode($client->get("https://www.metaweather.com/api/location/$cityId")->getBody()->getContents(),
            true)['consolidated_weather'];
        
        $city -> setPredictions($results);

    }

}

?>