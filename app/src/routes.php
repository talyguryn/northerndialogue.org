<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes


//$app->group('/{lang:[a-z]{2}}', function () use ($container){
//
//    //route for /{lang}
//    $this->get('', function () use ($container){
//
//        //show current lang id (ex : "fr")
//        var_dump($container->lang);
//
//        //show current lang dictionnay
//        var_dump($container->dictionary);
//
//        //show title and hello world
//        echo '<h1>' . $container->dictionary['title'] . '</h1>';
//        echo $container->dictionary['hello_world'];
//    })->setName('home');
//
//    //route for /{lang}/contact
//    $this->get('/contact', 'CALLED FONCTION')->setName('contact');
//});

$app->get('/', function (Request $request, Response $response, array $args) {
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/info', function (Request $request, Response $response, array $args) {
    return phpinfo();
});


$app->get('/trertert/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    $db = new \MicroDB\Database(PROJECT_ROOT . 'database/posts'); // data directory

    // create an item
    // id is an auto incrementing integer
    $id = $db->create(array(
        'title' => 'Lorem ipsum',
        'body' => 'At vero eos et accusam et justo duo dolores et ea rebum.'
    ));

    // Render index view
//    return $this->renderer->render($response, 'index.phtml', $args);
//    return $this->view->render($response, 'base.twig', [
//        'name' => $args['name']
//    ]);

    var_dump($args);

    return $this->view->fetchFromString('<p>Hi, my name is {{ name }}.</p>', [
        'name' => $args['name']
    ]);
});
