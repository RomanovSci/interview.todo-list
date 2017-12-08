<?php 

$injector = new \Auryn\Injector();

$injector->share('\Symfony\Component\HttpFoundation\Request');
$injector->define('\Symfony\Component\HttpFoundation\Request', [
    ':query' => $_GET,
    ':request' => $_POST,
    ':attributes' => [],
    ':cookies' => $_COOKIE,
    ':files' => $_FILES,
    ':server' => $_SERVER,
]);

$injector->share('\Symfony\Component\HttpFoundation\Response');

$injector->share('Twig_Environment');
$injector->define('Twig_Environment', [
    ':loader' => new Twig_Loader_Filesystem(__DIR__.'/../app/Views')
]);

return $injector;