<?php
// DIC configuration
use Medoo\Medoo;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;

$container = $app->getContainer();

// Register Twig View helper
$container['view'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    $view = new \Slim\Views\Twig($settings['template_path'], [
        'cache' => $settings['cache'],
        'debug' => $settings['debug'],
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new \Slim\Views\TwigExtension($c['router'], $basePath));
    $view->addExtension(new Twig_Extension_Debug());

    return $view;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

//medoo (database abstraction layer) https://medoo.in
$container['db'] = function ($c) {
    $settings = $c->get('settings')['db'];
	return new Medoo(
		$settings
	);
};

//flystyem https://github.com/thephpleague/flysystem
//Flysystem is a filesystem abstraction which allows you to easily swap out a local filesystem for a remote one. Technical debt is reduced as is the chance of vendor lock-in.
$container['disk']  = function ($c) {
    //$settings = $c->get('settings')['disk'];
    $adapter = new Local(__DIR__.'/../content/public');
    $filesystem = new Filesystem($adapter);
    return $filesystem;
};

function dump($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
