<?php

define('ROOT', 'https://finalizado-mvc-framework.com');

define('APP', str_replace('\\', '/', __DIR__));

// SEO
define('TITLE_SUFIX', ' - Website');

define('DEFAULT_KEYWORDS', 'website, site, online');

define('DEFAULT_DESCRIPTION', 'This is a description.');

define('DEFAULT_ROBOTS', 'index, follow');

define('CANONICAL_URL', ROOT . $_SERVER['REQUEST_URI']);

// DATABASE INFO
define('DATABASE', [
    'DRIVER' => '',
    'HOST' => 'localhost',
    'DBNAME' => '',
    'USER' => 'root',
    'PASSWORD' => ''
]);
