<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

// Composer Autoload
require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

/*
// Initialize the database connection
use Medoo\Medoo;

$database = new Medoo([
  // required
  'database_type' => 'mysql',
  'database_name' => 'webtracker_data',
  'server' => 'localhost',
  'username' => 'root',
  'password' => 'root',

  'charset' => 'utf8_general_ci',
  'port' => 3306
]);
*/

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Run app
$app->run();
