<?php

declare(strict_types=1);

namespace App\Support;

final class Config
{
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key] ?? $default;
        }

        $result = $this->data;

        foreach (explode('.', $key) as $offset) {
            if (!isset($result[$offset])) {
                return $default;
            }
            $result = $result[$offset];
        }

        return $result;
    }
}
