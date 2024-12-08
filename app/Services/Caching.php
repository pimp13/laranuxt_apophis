<?php

namespace App\Services;

use Closure;

class Caching
{
    public function store(string $key, $data, int $minutes = 10)
    {
        cache()->put($key, $data, $minutes);
    }

    public function get(string $key): mixed
    {
        return cache()->get($key);
    }

    public function forget(string $key): void
    {
        cache()->forget($key);
    }

    public function has(string $key): bool
    {
        return cache()->has($key);
    }

    public function refresh(string $key, $data, int $minutes = 10): mixed
    {
        // اگر کش وجود دارد، آن را پاک می‌کنیم
        if ($this->has($key)) {
            $this->forget($key);
        }

        // داده جدید را کش می‌کنیم
        $this->store($key, $data, $minutes);

        return $data; // برگرداندن داده جدید
    }

    public function rememberNoCallback(string $key, $data, int $minutes = 10): mixed
    {
        if ($this->has($key)) {
            return $this->get($key);
        } else {
            $this->store($key, $data, $minutes);
        }
        return $data;
    }

    public function remember(string $key, Closure $callback = null, int $minutes = 10): void
    {
        cache()->remember($key, $minutes, $callback);
    }

    public function pagination(string $model, $data, $minutes = 10): mixed
    {
        $curretPage = request()->get('page', 1);
        $keyGenerate =  $model . "_page_" . $curretPage;

        return $this->rememberNoCallback($keyGenerate, $data, $minutes);
    }

    public function keyFirstDataGenarator(string $key, string $modelId): string
    {
        return $key . "." . $modelId;
    }

    public function keyAllDataGenarator(string $key): string
    {
        return $key . "." . "all";
    }
}
