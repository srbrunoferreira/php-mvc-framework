<?php

declare(strict_types=1);

/**
 * Internal autoload like the Composer autoload.
 * 
 * @param string $filename
 * 
 * @return void
 */
function load(string $filename): void
{
    $file = explode('/', $filename)[0];

    if (strpos($filename, 'Controller')) {
        $folder = 'controller';
    } elseif (strpos($filename, 'Model')) {
        $folder = 'model';
    } else {
        $folder = 'core';
    }

    require_once APP . '/' . $folder . '/' . $file . '.php';
}
