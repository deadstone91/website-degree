<?php

$xml=simplexml_load_file("http://api.worldweatheronline.com/premium/v1/weather.ashx?key=1fd26ea130484c90a3d143759181212&q=edinburgh&date=today") or die("Error: Cannot create object");

$result = $xml -> xpath("/data/request/query");
$result2 = $xml -> xpath("/data/current_condition/observation_time");
$result3 = $xml -> xpath("/data/current_condition/temp_C");

echo "Reasonably local weather<br>";
Echo "<Strong>City: </Strong> ".$result[0];
echo "<br><strong>Time: </strong>".$result2[0];
echo "<br><strong>Temperature: </strong>".$result3[0]."oC";






//print_r($xml);