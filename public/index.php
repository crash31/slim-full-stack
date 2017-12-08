<?php

// Composer Autoload
require __DIR__ . '/../vendor/autoload.php';

session_start();


//pull in app settings
$settings = require __DIR__ . '/../src/settings.php';

//determine proper environment
$dev_tlds = [
    'loc',
    'dev',
    ''
];

if(in_array($_SERVER['TLD_SUFFIX'], $dev_tlds)){
    $mode = 'development';
} else {
    $mode = 'production';
}

// Instantiate the app
$app = new \Slim\App($settings[$mode]); //load settings file based on environment

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Run app
$app->run();
