<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'index.twig');
})->setName('main-page');

$app->get('/news', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'news.twig');
})->setName('news-page');


$app->get('/info', function (Request $request, Response $response, array $args) {
    return phpinfo();
});


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
