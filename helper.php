<?php 

    /**
     * Extract namespace from a PHP file
     *
     * @param  string $src
     * @return string
     */
    if(!function_exists('extractNamespace')){
        function extractNamespace(string $src) : string
        {
            $contents = file_exists($src) ? file_get_contents($src) : $src;
            if(preg_match('#^namespace\s+(.+?);$#sm', $contents, $m)){
                return $m[1];
            }
            return null;
        }
    }