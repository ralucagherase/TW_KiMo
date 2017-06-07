<?php
/**
 * Created by PhpStorm.
 * User: IRINA
 * Date: 07.06.2017
 */

// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://localhost/KiMo/api/markers/get/cli_token/eqJTNcpOQmdFKoBhhpa3',
    CURLOPT_POST => 0
));
// Send the request & save response to $resp
$markers = json_decode(curl_exec($curl));
// Close request to clear up some resources
curl_close($curl);

while(1){

    sleep(1);

    foreach($markers as $marker){

        // aici se seteaza cat de mult sa se miste

        $deltaLat = rand(1, 10)/100000;
        $deltaLng = rand(1, 10)/100000;

        $sign = rand(0, 1);
        if($sign == 1){
            $deltaLat = (-1) * $deltaLat;
        }
        $sign = rand(0, 1);
        if($sign == 1){
            $deltaLng = (-1) * $deltaLng;
        }

        $lat = floatval($marker->lat) + $deltaLat;
        $lng = floatval($marker->lng) + $deltaLng;

        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://localhost/KiMo/api/markers/move/id/' . $marker->id . '/lat/' . $lat . '/lng/' . $lng . '/cli_token/eqJTNcpOQmdFKoBhhpa3',
            CURLOPT_PUT => 1
        ));
        // Send the request & save response to $resp
        curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
    }
}

// Get cURL resource
/*$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://testcURL.com',
    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => array(
        item1 => 'value',
        item2 => 'value2'
    )
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);*/
?>