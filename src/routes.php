<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Create Routes Here

/*
$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->view->render($response, 'pages/landing.twig', $args);
});
*/

// Define named route
$app->get('/hello/{name}', function ($request, $response, $args) {
  return $this->view->render($response, 'pages/profile.twig', [
    'name' => $args['name']
  ]);
})->setName('profile');

// Render from string
$app->get('/hi/{name}', function ($request, $response, $args) {
  $str = $this->view->fetchFromString('<p>Hi, my name is {{ name }}.</p>', [
    'name' => $args['name']
  ]);
  $response->getBody()->write($str);
  return $response;
});


// disk test
$app->get('/disk', function ($request, $response, $args) {

    // write a file
    $directory = uniqid();
    //write
    $start = microtime(true);
    $this->disk->write($directory.'/file.txt', 'contents!!');
    $time_elapsed_secs = microtime(true) - $start;
    $benchmark['write'] = $time_elapsed_secs;
    // update a file
    $start = microtime(true);
    $this->disk->update($directory.'/file.txt', 'new contents');
    $time_elapsed_secs = microtime(true) - $start;
    $benchmark['update'] = $time_elapsed_secs;
    // read a file
    $start = microtime(true);
    $contents = $this->disk->read($directory.'/file.txt');
    $time_elapsed_secs = microtime(true) - $start;
    $benchmark['read'] = $time_elapsed_secs;
    // check if a file exists
    $start = microtime(true);
    $exists = $this->disk->has($directory.'/file.txt');
    $time_elapsed_secs = microtime(true) - $start;
    $benchmark['file_exists'] = $time_elapsed_secs;
    // rename a file
    $start = microtime(true);
    $this->disk->rename($directory.'/file.txt', $directory.'/newname.txt');
    $time_elapsed_secs = microtime(true) - $start;
    $benchmark['rename'] = $time_elapsed_secs;
    // copy a file
    $start = microtime(true);
    $this->disk->copy($directory.'/newname.txt', $directory.'/duplicate.txt');
    $time_elapsed_secs = microtime(true) - $start;
    $benchmark['copy'] = $time_elapsed_secs;
    // delete a file
    $start = microtime(true);
    $this->disk->delete($directory.'/newname.txt');
    $time_elapsed_secs = microtime(true) - $start;
    $benchmark['file_exists'] = $time_elapsed_secs;
    //create a directory
    $start = microtime(true);
    $this->disk->createDir($directory.'/deleteme');
    $time_elapsed_secs = microtime(true) - $start;
    $benchmark['create_directory'] = $time_elapsed_secs;
    // delete a directory
    $start = microtime(true);
    $this->disk->deleteDir($directory.'/deleteme');
    $time_elapsed_secs = microtime(true) - $start;
    $benchmark['delete_directory'] = $time_elapsed_secs;
    $args['disk'] = $benchmark;

    // Render index view
    return $this->view->render($response, 'pages/status.twig', $args);
});
