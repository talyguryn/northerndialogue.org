<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'pages/index.twig');
})->setName('main-page');

$app->get('/about', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'pages/about.twig');
})->setName('about-page');

$app->get('/programme', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'pages/programme.twig');
})->setName('programme-page');

$app->get('/speakers', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'pages/speakers.twig');
})->setName('speakers-page');

$app->get('/participation', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'pages/participation.twig');
})->setName('participation-page');

$app->get('/partnership', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'pages/partnership.twig');
})->setName('partnership-page');

$app->get('/organizers', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'pages/organizers.twig');
})->setName('organizers-page');

$app->get('/contacts', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'pages/contacts.twig');
})->setName('contacts-page');



//$app->get('/twig/[{name}]', function (Request $request, Response $response, array $args) {
//    // Sample log message
//    $this->logger->info("Slim-Skeleton '/' route");
//
//    $db = new \MicroDB\Database(PROJECT_ROOT . 'database/posts'); // data directory
//
//    // create an item
//    // id is an auto incrementing integer
//    $id = $db->create(array(
//        'title' => 'Lorem ipsum',
//        'body' => 'At vero eos et accusam et justo duo dolores et ea rebum.'
//    ));
//
//    return $this->view->render($response, 'base.twig', [
//        'name' => $args['name']
//    ]);
//});
