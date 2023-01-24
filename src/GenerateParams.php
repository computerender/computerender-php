<?php

namespace Computerender;

use GuzzleHttp\Psr7\Utils;

class GenerateParams implements \JsonSerializable
{
    public string $prompt;
    public ?int $seed;
    public ?int $w;
    public ?int $h;
    public ?int $guidance;
    public ?int $iterations;
    public ?int $eta;
    public mixed $img;
    public ?int $strength;
    public ?string $modelVersion;
    public ?string $extension; // Can be "png" or "jpg"

    public function __construct(array $params = [])
    {
        $this->prompt = $params['prompt'];
        $this->seed = $params['seed'] ?? null;
        $this->w = $params['w'] ?? null;
        $this->h = $params['h'] ?? null;
        $this->guidance = $params['guidance'] ?? null;
        $this->iterations = $params['iterations'] ?? null;
        $this->eta = $params['eta'] ?? null;
        $this->img = $params['img'] ?? null;
        $this->strength = $params['strength'] ?? null;
        $this->modelVersion = $params['modelVersion'] ?? null;
        $this->extension = $params['extension'] ?? null;
    }

    public function prompt(string $prompt): static
    {
        $this->prompt = $prompt;
        return $this;
    }

    public function seed(string $seed = null): self
    {
        $this->seed = $seed;
        return $this;
    }

    public function w(string $w = null): self
    {
        $this->w = $w;
        return $this;
    }

    public function h(string $h = null): self
    {
        $this->h = $h;
        return $this;
    }

    public function guidance(string $guidance = null): self
    {
        $this->guidance = $guidance;
        return $this;
    }

    public function iterations(string $iterations = null): self
    {
        $this->iterations = $iterations;
        return $this;
    }

    public function eta(string $eta = null): self
    {
        $this->eta = $eta;
        return $this;
    }

    public function img(string $img = null): self
    {
        $this->img = $img;
        return $this;
    }

    public function strength(string $strength = null): self
    {
        $this->strength = $strength;
        return $this;
    }

    public function modelVersion(string $modelVersion = null): self
    {
        $this->modelVersion = $modelVersion;
        return $this;
    }

    public function extension(string $extension = null): self
    {
        $this->extension = $extension;
        return $this;
    }

    public function asArray(): array
    {
        return [
            'prompt' => $this->prompt,
            'seed' => $this->seed,
            'w' => $this->w,
            'h' => $this->h,
            'guidance' => $this->guidance,
            'iterations' => $this->iterations,
            'eta' => $this->eta,
            'img' => $this->img,
            'strength' => $this->strength,
            'modelVersion' => $this->modelVersion,
            'extension' => $this->extension,
        ];
    }

    public function asMultipartArray(): array
    {
        $multipart = [];
        foreach ($this->asArray() as $key => $value) {
            if ($value === null) {
                continue;
            }

            if ($key == 'img' && is_string($value)) {
                $file = Utils::tryFopen($value, 'r');
                $value = $file;
            }

            $multipart[] = [
                'name' => $key,
                'contents' => $value,
            ];
        }
        return $multipart;
    }

    public function jsonSerialize(): array
    {
        return $this->asArray();
    }
}