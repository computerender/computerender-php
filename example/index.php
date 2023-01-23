<?php

$prompt = "hipster cats";

$client = new \Lukeholder\Computerrender\Client("<YOUR-API-KEY>");
$image = $client->generate([
    'prompt' => $prompt,
]);

echo "<img src='data:image/jpeg;base64, " . base64_encode($image) . "' />";
