<?php

namespace App\Controllers;

use Http\Request;
use Http\Response;

class UserController
{
    protected $request;
    protected $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
}