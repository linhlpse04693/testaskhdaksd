<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

if (!function_exists('collect')) {
    function collect($items): Collection
    {
        return new Collection($items);
    }
}

if (!function_exists('base_path')) {
    function base_path($path = ''): string
    {
        return __DIR__ . "/../$path";
    }
}

if (!function_exists('config_path')) {
    function config_path($path = ''): string
    {
        return base_path("config/$path");
    }
}

if (!function_exists('throw_when')) {
    function throw_when(bool $fails, string $message, string $exception = Exception::class): void
    {
        if (!$fails) return;

        throw new $exception($message);
    }
}

if (!function_exists('config')) {
    function config($path = null): mixed
    {
        $config = app()->resolve('config');

        return data_get($config, $path);
    }
}

if (!function_exists('data_get')) {
    function data_get($target, $key, $default = null)
    {
        if (is_null($key)) {
            return $target;
        }

        $key = is_array($key) ? $key : explode('.', $key);

        while (!is_null($segment = array_shift($key))) {
            if ($segment === '*') {
                if ($target instanceof Collection) {
                    $target = $target->all();
                } elseif (!is_array($target)) {
                    return value($default);
                }

                $result = [];

                foreach ($target as $item) {
                    $result[] = data_get($item, $key);
                }

                return in_array('*', $key) ? Arr::collapse($result) : $result;
            }

            if (Arr::accessible($target) && Arr::exists($target, $segment)) {
                $target = $target[$segment];
            } elseif (is_object($target) && isset($target->{$segment})) {
                $target = $target->{$segment};
            } else {
                return value($default);
            }
        }
    }

    return $target;
}
