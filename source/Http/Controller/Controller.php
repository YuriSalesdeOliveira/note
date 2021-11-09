<?php

namespace Source\Http\Controller;

use Jenssegers\Blade\Blade;

class Controller
{
    protected Blade $blade;

    public function __construct()
    {
        $this->blade = new Blade(PATH['view'], PATH['cache']);
    }
}

