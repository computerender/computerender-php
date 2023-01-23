<?php

use Lukeholder\Computerrender\Client;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

it('instantiates', function () {
    $apiKey = $_ENV['CR_KEY'];
    $client = new Client($apiKey);
    expect($client)->toBeInstanceOf(Client::class);
    expect($client->apiKey)->toBe($apiKey);
});

it('should generate an image', function () {
    $apiKey = $_ENV['CR_KEY'];
    $client = new Client($apiKey);
    $params = [
        'prompt' => 'Hipster Cat',
    ];
    $image = $client->generate($params);
    expect($image)->toBeTruthy();
});

it('should generate an image to disk', function () {
    $apiKey = $_ENV['CR_KEY'];
    $client = new Client($apiKey);
    $params = [
        'prompt' => 'Hipster Cat',
    ];
    $image = $client->generate($params);
    $result = file_put_contents(__DIR__ . '/hipster-cat.jpg', $image);
    expect($result)->toBeTruthy();
    $file = __DIR__ . '/hipster-cat.jpg';
    expect($file)->toBeFile();
});

it('should generate an image2image', function () {
    $apiKey = $_ENV['CR_KEY'];
    $client = new Client($apiKey);
    $params = [
        'prompt' => 'pink',
        'img' => __DIR__ . '/hipster-cat.jpg',
    ];
    $image = $client->generate($params);
    $result = file_put_contents(__DIR__ . '/hipster-cat-pink.jpg', $image);
    expect($result)->toBeTruthy();
    $file = __DIR__ . '/hipster-cat-pink.jpg';
    expect($file)->toBeFile();
});