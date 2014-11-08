<?php
require_once "vendor/autoload.php";

$app = new \Slim\Slim(array(
    'view' => new \Slim\Views\Twig
));

$app->get('/', function() use ($app) {
    $app->render('index.html.twig');
});

$app->post('/', function () use ($app) {
    $service = new \TrueNorth\Password\Generator();
    $app->render('password.html.twig', [
        'secret' => $service->generate(
            $app->request->post('site'),
            $app->request->post('unguessable')
        )
    ]);
});

$app->run();