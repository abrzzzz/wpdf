<?php


if( ! function_exists( '_wpdf' ) ) 
{
    function _wpdf()
    {
        return Abrz\WPDF\Foundation\Application::getInstance();
    }
}

if (!function_exists('dd')) {
    /**
     * @return never
     */
    function dd(...$vars): void
    {
        if (!in_array(\PHP_SAPI, ['cli', 'phpdbg'], true) && !headers_sent()) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        foreach ($vars as $v) {
            Symfony\Component\VarDumper\VarDumper::dump($v);
        }

        exit(1);
    }
}