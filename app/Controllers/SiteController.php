<?php declare(strict_types = 1);

namespace BeeJee\Controllers;

use Http\Response;

class SiteController
{
    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function index()
    {
        $this->response->setContent('Main page');
    }

    public function help()
    {
        $this->response->setContent('Help page');
    }
}