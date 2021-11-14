<?php

namespace Source\Http\Controller;

class App extends Controller
{
    public function error($data)
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        echo 'error:' . $data['errcode'];
    }
}