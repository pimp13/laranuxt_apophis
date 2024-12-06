<?php

namespace App\Services;

use Illuminate\Contracts\Cache\Repository as Cache;

class Caching
{
    private Cache $cache;
    private const CACHE_EXPIRATION = 120;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }
    /**
     * Saving data to cache
     *
     * @param string $key
     * @param mixed $data
     * @param int $minutes
     * @return void
     */
    public function store(string $key, $data, int $minutes = self::CACHE_EXPIRATION)
    {
        $this->cache->put($key, $data, now()->addMinutes($minutes));
    }

    /**
     * Get data from cache
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key): mixed
    {
        return $this->cache->get($key);
    }

    /**
     * Delete data from cache
     *
     * @param string $key
     * @return void
     */
    public function forget(string $key): void
    {
        $this->cache->forget($key);
    }

    /**
     * is Check exists data from cache
     *
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return $this->cache->has($key);
    }

    /**
     * چک کردن وجود داده در کش و اگر نبود، کش را به‌روز رسانی کند.
     * در صورت وجود کش، آن را پاک کرده و کش جدید ذخیره کند.
     *
     * @param string $key
     * @param mixed $data
     * @param int $minutes
     * @return mixed
     */
    public function refresh(string $key, $data, int $minutes = 60)
    {
        // اگر کش وجود دارد، آن را پاک می‌کنیم
        if ($this->has($key)) {
            $this->forget($key);
        }

        // داده جدید را کش می‌کنیم
        $this->store($key, $data, $minutes);

        return $data; // برگرداندن داده جدید
    }

    /**
     * چک کردن وجود داده در کش و اگر نبود، کش را به‌روز رسانی کند.
     * در صورت وجود کش، آن را برگرداند.
     *
     * @param string $key
     * @param mixed $data
     * @param int $minutes
     * @return mixed
     */
    public function remember(string $key, $data, int $minutes = 60)
    {
        $this->cache->remember($key, $minutes, fn() => $data);
    }
}
