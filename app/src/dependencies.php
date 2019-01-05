<?php

$container = $app->getContainer();

/**
 * View renderer
 */
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

/**
 * Monolog
 */
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];

    $logger = new Monolog\Logger($settings['name']);

    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));

    return $logger;
};

/**
 * Hawk catcher
 */
$container['hawk'] = function ($c) {
    $settings = $c->get('settings')['hawk'];

    $logger = new Monolog\Logger($settings['name']);

    if ($settings['token']) {
        // Send error to Hawk
        $logger->pushHandler(new \Hawk\Monolog\Handler($settings['token'], $settings['level']));

        // Write down to log file
        $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    }

    return $logger;
};

/**
 * Set up error handler
 *
 * @todo create a separate class
 */
$container['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        // Send error to Hawk
        $c->hawk->error($exception->getMessage(), ['exception' => $exception]);

        return $response->withStatus(500)
                        ->withHeader('Content-Type', 'text/html')
                        ->write('Something went wrong!');
    };
};


$container['phpErrorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        // Send error to Hawk
        $c->hawk->error($exception->getMessage(), ['exception' => $exception]);

        return $response->withStatus(500)
                        ->withHeader('Content-Type', 'text/html')
                        ->write('Something went wrong!');
    };
};

/**
 * Twig processor
 */
$container['view'] = function ($c){
    $view = new \Slim\Views\Twig(PROJECT_ROOT . 'views', [
        'cache' => false
    ]);

    $view->addExtension(new App\TwigExtensions($c));

    $router = $c->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new Slim\Views\TwigExtension($router, $uri));

    return $view;
};