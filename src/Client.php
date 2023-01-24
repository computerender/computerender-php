<?php

namespace Computerender;

use Psr\Http\Client\ClientInterface as HttpClientInterface;
use GuzzleHttp\Client as GuzzleClient;

class Client
{
    public ?string $apiKey = null;

    private string $baseUrl = 'https://api.computerender.com/';
    private HttpClientInterface $httpClient;

    public function __construct(string $apiKey = null, HttpClientInterface $httpClient = null)
    {
        $this->httpClient = $httpClient ?? new GuzzleClient([
            'base_uri' => $this->baseUrl,
            'timeout' => 50.0,
        ]);

        if ($apiKey === null) {
            throw new \Exception("No API key provided");
        }

        if (str_starts_with((string)$apiKey, "sk_")) {
            $this->apiKey = $apiKey;
        } else throw new \Exception("apiKey format was not recognized");
    }

    /**
     * @param GenerateParams $params
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function generate(GenerateParams|array $params)
    {
        if (is_array($params)) {
            $params = new GenerateParams($params);
        }

        $response = $this->httpClient->request('POST', 'generate', [
            'multipart' => $params->asMultipartArray(),
            'headers' => [
                "X-API-Key" => $this->apiKey,
            ]
        ]);

        if($response->getStatusCode() === 200) {
            return $response->getBody()->getContents();
        } else {
            throw new \Exception("Error: " . $response->getStatusCode() . " " . $response->getReasonPhrase());
        }
    }
}