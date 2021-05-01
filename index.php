<?php

$base_url = "https://api.scripture.api.bible/v1/bibles";


$options = array(
    CURLOPT_HTTPHEADER => array('api-key' => '8c8de8fe0870481e33ad2d3d12495aa5'),
    CURLOPT_HTTP_GET => true,
);

$curl = curl_init($base_url, $options);

curl_setopt_array($curl, $options);

$result = curl_exec($curl);

echo $result;
