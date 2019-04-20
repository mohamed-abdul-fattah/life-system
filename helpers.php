<?php

session_start();

if ( ! function_exists('public_path') ) {
    /**
     * Return public path concatenated with the provided path
     *
     * @param string $path
     * @return string
     */
    function public_path(string $path = ""): string
    {
        $path = ($path) ? leading_slash($path) : NULL;

        return __DIR__ . '/public/' . $path;
    }
}

if ( ! function_exists('leading_slash') ) {
    /**
     * Make sure that the given string has no leading back-slash
     *
     * @param string $path
     * @return string
     */
    function leading_slash(string $path): string
    {
        return ($path[0] === '/') ? substr($path, 1) : $path;
    }
}

if ( ! function_exists('url') ) {
    /**
     * Return the website URL
     *
     * @param string $url
     * @return string
     */
    function url(string $url = NULL): string
    {
        $url = ($url) ? leading_slash($url) : NULL;

        return 'http://life-system.local/' . $url;
    }
}

if ( ! function_exists('redirect') ) {
    /**
     * Redirect to the desired URL
     *
     * @param string|null $url
     * @return void
     */
    function redirect(string $url = NULL)
    {
        $fullPath = url($url);

        header("Location: {$fullPath}");
        die;
    }
}