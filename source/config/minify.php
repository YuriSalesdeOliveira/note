<?php

use MatthiasMullie\Minify\CSS;
use MatthiasMullie\Minify\JS;

if (DEVELOPMENT) {

    /**
     * SITE
     * css
     */

    $minCSS = new CSS();
    $minCSS->add(PATH['view'] . '/site/asset/css/reset.css');
    $minCSS->add(PATH['view'] . '/site/asset/css/colors.css');
    $minCSS->add(PATH['view'] . '/site/asset/css/message.css');
    $minCSS->add(PATH['view'] . '/site/asset/css/main.css');
    $minCSS->add(PATH['view'] . '/site/asset/css/login.css');
    $minCSS->minify(PATH['public'] . '/site/asset/css/style.min.css');

    /**
     * SITE
     * js
     */

    $minJS = new JS();
    $minJS->add(PATH['view'] . '/site/asset/js/modal.js');
    $minJS->minify(PATH['public'] . '/site/asset/js/main.js');

}
