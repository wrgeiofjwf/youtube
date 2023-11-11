<?php

// change this to match your channel and api key
// you also should put these credentials in a safer location (for instance in some environment variables)
$channelId = "UCvTJQvdNWE0hw2sS3QQOWeA";
$apiKey = "AIzaSyDaTY_FLsNW43t208WwEhb6x8TxCs7jrDU";

$urlToGet = "https://www.googleapis.com/youtube/v3/channels?id=" . $channelId . "&key=" . $apiKey . "&part=statistics";
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $urlToGet,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET"
]);
$response = curl_exec($ch);
curl_close($ch);
$jsonS = json_decode($response);
$subscribers = 0;
$views = 0;
if ($jsonS && $jsonS->items && $jsonS->items[0]) {
    $subscribers = $jsonS->items[0]->statistics->subscriberCount;
    $views = $jsonS->items[0]->statistics->viewCount;
} else {
    // var_dump($response);
}
$result = ['number' => $subscribers, 'subscribers' => $subscribers, 'views' => $views];

echo json_encode($result, JSON_FORCE_OBJECT);

?>
