<?php

/** Prevent uninitialized SESSION_ID from browser */
ini_set('session.use_strict_mode', 1);
ini_set('session.name', 'token');
session_set_cookie_params(1800, '/', '', false, true);
session_start();

if ( ! function_exists('session_push') ) {
    /**
     * Push a value to the session array
     *
     * @param string $key
     * @param mixed  $value
     */
    function session_push($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}

if ( ! function_exists('session_pull') ) {
    /**
     * @param string     $key
     * @param mixed|null $default
     * @return mixed|null
     */
    function session_pull($key, $default = NULL)
    {
        if ( array_key_exists($key, $_SESSION) ) {
            $value = $_SESSION[$key];
            unset($_SESSION[$key]);
        } else {
            $value = $default;
        }

        return $value;
    }
}

if ( ! function_exists('session_has') ) {
    /**
     * Check whether the session has a certain key or not
     *
     * @param string $key
     * @return bool
     */
    function session_has($key)
    {
        return array_key_exists($key, $_SESSION);
    }
}