<?php

declare(strict_types=1);

// If the user accesses the site via HTTP, he is redirected to HTTPS.
if (!isset($_SERVER['HTTPS']) && !isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && !isset($_SERVER['HTTP_X_FORWARDED_SSL'])) {
    $httpsUrl = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('Location: ' . $httpsUrl);
    exit;
}

function s($s): void
{
    echo '<hr>';
    print_r($s);
    echo '<hr>';
}

require_once '../app/config.php';
require_once '../app/helper/autoload.php';
require_once '../app/core/Router.php';

Router::addRoute('/', 'SiteController/home');
Router::addRoute('/contact/', 'SiteController/contact');
Router::addRoute('/about/', 'SiteController/about');
Router::addRoute('/user/delete/{id}/', 'SiteController/delete', [2], ['int']);
Router::addRoute('/{string}/settings/{id}/create/', 'SiteController/delete', [0, 2], ['str', 'int']);
Router::dispatch();
