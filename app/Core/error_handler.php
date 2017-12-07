<?php

$environment = 'development';
$whoops = new \Whoops\Run;

if ($environment !== 'production') {
    $whoops->pushHandler(
        new \Whoops\Handler\PrettyPageHandler
    );
} else {
    $whoops->pushHandler(function($e){
        echo 'Oooopps...Something went wrong';
    });
}

$whoops->register();