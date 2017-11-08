<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

// Define named route
$app->get('/hello/{name}', function ($request, $response, $args) {
  return $this->view->render($response, 'profile.html', [
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
