<?php

if (! function_exists('public_path'))
{
    /**
     * Return public path concatenated with the provieded path
     *
     * @param  string $path
     * @return string 
     */
    function public_path(string $path = null): string
    {
        $path = ($path[0] === '/') ? substr($path, 1) : $path;

        return __DIR__. "/public/" . $path;
    }
}
