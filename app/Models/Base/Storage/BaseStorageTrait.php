<?php

namespace App\Models\Base\Storage;

trait BaseStorageTrait
{
    /**
     * @return string
     */
    public static function getStorageKey(): string
    {
        return static::SINGLE_STORAGE_KEY;
    }

    /**
     * @param  $data
     */
    public static function put($data): void
    {
        session()->put(self::getStorageKey(), $data);
    }

    /**
     * @return void
     */
    public static function clear(): void
    {
        session()->forget(self::getStorageKey());
    }

    /**
     * @return bool
     */
    public static function exists(): bool
    {
        return session()->has(self::getStorageKey());
    }

    /**
     * @return mixed
     */
    public static function current()
    {
        return session()->get(self::getStorageKey());
    }

}