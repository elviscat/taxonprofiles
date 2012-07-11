<?php

$ch = curl_init();
$options = array(CURLOPT_URL => 'www.yahoo.com.tw',
CURLOPT_HEADER => false,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_USERAGENT => "Google Bot",
CURLOPT_FOLLOWLOCATION => true
);
curl_setopt_array($ch, $options);
$output = curl_exec($ch);
curl_close($ch);
echo $output;


?>