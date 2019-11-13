<?php

namespace Codium\CleanCode;

use GuzzleHttp\Client;

class Forecast
{
    public function predict(City &$city, \DateTime $datetime = null, bool $wind = false): string
    {
        // When date is not provided we look for the current prediction
        if (!$datetime) {
            $datetime = new \DateTime();
        }

        // If there are predictions
        if ($datetime < new \DateTime("+6 days 00:00:00")) {
            $city = new City();
            $predictionsController = new PredictionsController(); 

            foreach ($results as $result) {

                // When the date is the expected
                if ($result["applicable_date"] == $datetime->format('Y-m-d')) {
                    // If we have to return the wind information
                    if ($wind) {
                        return $result['wind_speed'];
                    } else {
                        return $result['weather_state_name'];
                    }
                }
            }
        } else {
            return "";
        }
    }
}