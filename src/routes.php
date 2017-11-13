<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Create Routes Here

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->view->render($response, 'pages/landing.twig', $args);
});

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
