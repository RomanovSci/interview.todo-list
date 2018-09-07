<?php

namespace App\Controllers;

use \Twig_Environment as Twig;

class SiteController
{
    protected $twig;

    /**
     * SiteController constructor.
     *
     * @param Twig $twig
     */
    public function __construct(Twig $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Render main page
     *
     * @return string
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index()
    {
        return $this->twig->render('index.twig');
    }
}
