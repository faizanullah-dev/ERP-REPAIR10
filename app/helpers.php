<?php

/**
 * Laravel 11 Helper Functions
 * 
 * This file contains helper functions that were removed in Laravel 11
 * but are still used in the codebase for backward compatibility.
 */

if (!function_exists('str_slug')) {
    /**
     * Generate a URL friendly "slug" from a given string.
     *
     * @param  string  $title
     * @param  string  $separator
     * @param  string|null  $language
     * @return string
     */
    function str_slug($title, $separator = '-', $language = 'en')
    {
        return \Illuminate\Support\Str::slug($title, $separator, $language);
    }
}

if (!function_exists('array_add')) {
    /**
     * Add an element to an array using "dot" notation if it doesn't exist.
     *
     * @param  array   $array
     * @param  string  $key
     * @param  mixed   $value
     * @return array
     */
    function array_add($array, $key, $value)
    {
        return \Illuminate\Support\Arr::add($array, $key, $value);
    }
}

if (!function_exists('array_divide')) {
    /**
     * Divide an array into two arrays. One with keys and the other with values.
     *
     * @param  array  $array
     * @return array
     */
    function array_divide($array)
    {
        return [\array_keys($array), \array_values($array)];
    }
}

if (!function_exists('array_first')) {
    /**
     * Return the first element in an array passing a given truth test.
     *
     * @param  array  $array
     * @param  callable|null  $callback
     * @param  mixed  $default
     * @return mixed
     */
    function array_first($array, callable $callback = null, $default = null)
    {
        return \Illuminate\Support\Arr::first($array, $callback, $default);
    }
}

if (!function_exists('array_last')) {
    /**
     * Return the last element in an array passing a given truth test.
     *
     * @param  array  $array
     * @param  callable|null  $callback
     * @param  mixed  $default
     * @return mixed
     */
    function array_last($array, callable $callback = null, $default = null)
    {
        return \Illuminate\Support\Arr::last($array, $callback, $default);
    }
}

if (!function_exists('str_contains')) {
    /**
     * Determine if a given string contains a given substring.
     *
     * @param  string  $haystack
     * @param  string|array  $needles
     * @return bool
     */
    function str_contains($haystack, $needles)
    {
        return \Illuminate\Support\Str::contains($haystack, $needles);
    }
}

if (!function_exists('str_finish')) {
    /**
     * Cap a string with a single instance of a given value.
     *
     * @param  string  $value
     * @param  string  $cap
     * @return string
     */
    function str_finish($value, $cap)
    {
        return \Illuminate\Support\Str::finish($value, $cap);
    }
}

if (!function_exists('str_is')) {
    /**
     * Determine if a given string matches a given pattern.
     *
     * @param  string|array  $pattern
     * @param  string  $value
     * @return bool
     */
    function str_is($pattern, $value)
    {
        return \Illuminate\Support\Str::is($pattern, $value);
    }
}

if (!function_exists('str_limit')) {
    /**
     * Limit the number of characters in a string.
     *
     * @param  string  $value
     * @param  int     $limit
     * @param  string  $end
     * @return string
     */
    function str_limit($value, $limit = 100, $end = '...')
    {
        return \Illuminate\Support\Str::limit($value, $limit, $end);
    }
}

if (!function_exists('str_random')) {
    /**
     * Generate a more truly "random" alpha-numeric string.
     *
     * @param  int  $length
     * @return string
     */
    function str_random($length = 16)
    {
        return \Illuminate\Support\Str::random($length);
    }
}

