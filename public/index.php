<?php

// include_once("../chrome_php_debugger.php");
// ChromePhp::log(__DIR__);

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

// must use Dotenv AFTER vendor/autoload.php BUT BEFORE these environment variables are needed by src/dependencies.php below!!!
// https://stackoverflow.com/questions/37199237/fatal-error-class-dotenv-dotenv-not-found-in
$dotenv = new Dotenv\Dotenv(__DIR__ . "/../");
$dotenv->load();

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Run app
$app->run();
