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
    function public_path(string $path = ''): string
    {
        $path = ($path) ? no_leading_slash($path) : NULL;

        return __DIR__ . '/public/' . $path;
    }
}

if ( ! function_exists('no_leading_slash') ) {
    /**
     * Make sure that the given string has no leading back-slash
     *
     * @param string $path
     * @return string
     */
    function no_leading_slash(string $path): string
    {
        return ($path[0] === '/') ? substr($path, 1) : $path;
    }
}

if ( ! function_exists('trailing_slash') ) {
    /**
     * Ensure that the given URL has a trailing slash at the end
     *
     * @param string $url
     * @return string
     */
    function trailing_slash(string $url): string
    {
        $urlLength = strlen($url);
        return ($url[$urlLength - 1] === '/') ? $url : $url . '/';
    }
}

if ( ! function_exists('url') ) {
    /**
     * Return the website URL
     *
     * @param string $url
     * @return string
     * @throws Exception
     */
    function url(string $url = NULL): string
    {
        $url = ($url) ? no_leading_slash($url) : NULL;

        return base_url() . $url;
    }
}

if ( ! function_exists('base_url') ) {
    /**
     * Get application base URL
     *
     * @return string
     * @throws Exception
     */
    function base_url(): string
    {
        $url = getConfig('APP_URL', 'http://localhost/');
        return trailing_slash($url);
    }
}

if ( ! function_exists('redirect') ) {
    /**
     * Redirect to the desired URL
     *
     * @param string|null $url
     * @return void
     * @throws Exception
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
     *
     * @throws Exception
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
     *
     * @throws Exception
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
    function getConfig(string $key = NULL, $default = NULL)
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

if ( ! function_exists('paginationIndexes') ) {
    /**
     * Get pagination instructions to be followed by
     * the client side.
     *
     * @param int $current
     * @param int $last
     * @return array
     * @throws Exception
     */
    function paginationIndexes($current, $last): array
    {
        $range = getPaginationRange($current, $last);
        $pagination = [
            'prev'      => [
                'URL'        => url('expenses/?page=') . ($current - 1),
                'disability' => (bool) (1 == $current)
            ],
            'next'      => [
                'URL'        => url('/expenses/?page=') . ($current + 1),
                'disability' => (bool) ($current == $last)
            ],
            'indexes'   => $range,
            'firstPage' => [
                'URL'     => url('/expenses/'),
                'display' => 1 != $range[0],
                'active'  => (bool) (1 == $current)
            ],
            'lastPage'  => [
                'URL'     => url('/expenses/?page=') . $last,
                'display' => $range[count($range) - 1] < $last,
                'active'  => (bool) ($last == $current)
            ]
        ];

        return $pagination;
    }
}

if ( ! function_exists('getPaginationRange') ) {
    /**
     * Get pagination indexes to be displayed according to
     * the current and last pages.
     *
     * @param int $current
     * @param int $last
     * @return array
     */
    function getPaginationRange($current, $last): array
    {
        if ( $last < 5 ) {
            return range(1, $last);
        } elseif ( $current <= 2 ) {
            return range(1, 5);
        } elseif ( $current < ($last - 1) ) {
            return range($current - 2, $current + 2);
        }
        return range($last - 4, $last);
    }
}

if ( ! function_exists('inject') ) {
    /**
     * Inject a partial template into a page with
     * some defined variables.
     *
     * @param string $path
     * @param array $args
     * @return string
     */
    function inject($path, $args = [])
    {
        ob_start();
        extract($args, EXTR_OVERWRITE);
        @include public_path($path);
        echo ob_get_clean();
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
        echo '<pre>';
        var_dump($dump);
        echo '</pre>';
        die;
    }
}

/**
 * Get an environment value
 *
 * @param  string $name
 * @param  mixed $default
 * @return string|null
 */
function env($name, $default = null)
{
    $value = $_ENV[$name];
    if (is_null($value) && ! is_null($default)) {
        return $default;
    }
    return $value;
}
