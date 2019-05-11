<?php

require_once __DIR__ . '/sessions.php';
require_once __DIR__ . '/databases.php';

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

if ( ! function_exists('auth_check') ) {
    /**
     * Checks whether a user is logged in or not.
     *
     * @return bool
     */
    function auth_check(): bool
    {
        return (bool) (isset($_SESSION['isLoggedIn']))
            ? $_SESSION['isLoggedIn']
            : false;
    }
}

if ( ! function_exists('require_auth') ) {
    /**
     * The requested web page requires authentication.
     */
    function require_auth()
    {
        if ( ! auth_check() ) {
            redirect('/login.php');
        }
    }
}

if ( ! function_exists('guest_check') ) {
    /**
     * User cannot access the page unless he is logged out.
     */
    function guest_check()
    {
        if ( auth_check() ) {
            redirect('/');
        }
    }
}

if ( ! function_exists('getConfig') ) {
    /**
     * Get configurations array, or a single key.
     *
     * @param string|null $key
     * @param string|null $default
     * @return mixed
     * @throws Exception
     */
    function getConfig($key = NULL, $default = NULL)
    {
        $configs = @include __DIR__ . '/configs.php';

        if ( ! is_array($configs) ) {
            throw new Exception('Cannot load configs', 500);
        }

        if ( ! is_null($key) ) {
            if ( array_key_exists($key, $configs) ) {
                return $configs[$key];
            } else {
                return $default;
            }
        }

        return $configs;
    }
}



if ( ! function_exists('dd') ) {
    /**
     * Die and dump.
     *
     * @param mixed $dump
     */
    function dd($dump)
    {
        die(var_dump($dump));
    }
}