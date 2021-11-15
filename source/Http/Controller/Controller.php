<?php

namespace Source\Http\Controller;

use CoffeeCode\Router\Router;
use Jenssegers\Blade\Blade;

class Controller
{
    protected Blade $blade;
    protected Router $router;

    public function __construct(Router $router)
    {
        $this->blade = new Blade(PATH['view'], PATH['cache']);

        $this->router = $router;

        $this->blade->share(['router' => $router]);
    }
}

