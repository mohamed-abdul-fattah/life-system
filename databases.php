<?php

if ( ! function_exists('open_connection') ) {
    /**
     * Open database connection
     *
     * @return false|mysqli
     * @throws Exception
     */
    function open_connection()
    {
        $connection = mysqli_connect(
            getConfig('DB_HOST'),
            getConfig('DB_USER'),
            getConfig('DB_PASS'),
            getConfig('DB_NAME')
        );

        if ( mysqli_connect_errno() ) {
            throw new Exception('Connection failed: ' . mysqli_connect_error(), 500);
        }

        set_charset($connection, 'utf8');

        return $connection;
    }
}

if ( ! function_exists('set_charset') ) {
    /**
     * Set database charset names.
     *
     * @param mysqli $connection
     * @param string $charset
     * @throws Exception
     */
    function set_charset($connection, string $charset)
    {
        if ( ! mysqli_set_charset($connection, $charset) ) {
            throw new Exception(
                "Error loading character set {$charset} " . mysqli_error($connection),
                500
            );
        }
    }
}

if ( ! function_exists('close_connection') ) {
    /**
     * Close database connection
     *
     * @param mysqli $connection
     */
    function close_connection($connection)
    {
        mysqli_close($connection);
    }
}