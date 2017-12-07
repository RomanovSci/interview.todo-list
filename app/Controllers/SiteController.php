<?php

namespace BeeJee\Controllers;

use Http\Request;
use Http\Response;
use \Twig_Environment as Twig;

class SiteController
{
    protected $request;
    protected $response;
    protected $twig;

    public function __construct(Request $request, Response $response, Twig $twig) {
        $this->request = $request;
        $this->response = $response;
        $this->twig = $twig;
    }

    public function index()
    {
        $this->response->setContent(
            $this->twig->render('index.twig', ['name' => 'test'])
        );
    }

    public function help()
    {
        $this->response->setContent('Help page');
    }
}