<?php

namespace BeeJee\Controllers;

use Http\Request;
use Http\Response;
use \Twig_Environment as Twig;

class SiteController
{
    protected $request;
    protected $twig;

    /**
     * SiteController constructor.
     *
     * @param Request $request
     * @param Twig $twig
     */
    public function __construct(Request $request, Twig $twig) {
        $this->request = $request;
        $this->twig = $twig;
    }

    /**
     * Render main page
     *
     * @return string
     */
    public function index()
    {
        return $this->twig->render('index.twig');
    }
}