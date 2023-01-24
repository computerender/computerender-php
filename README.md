# PHP client for [computerender](https://computerender.com)

An easy to use image generation API

### Install (coming soon):
```composer require x/computerrender-php```

### Usage:
```php
$prompt = "hipster cats";

$client = new Computerrender\Client("<YOUR-API-KEY>");
$image = $client->generate([
    'prompt' => $prompt,
]);

echo "<img src='data:image/jpeg;base64, " . base64_encode($image) . "' />";
```

### See more info here:
https://computerender.com/models-sd.html


### Tests

Add a `tests/.env` file with your API key.

```bash
composer run tests
```