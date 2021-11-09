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
    $minCSS->minify(PATH['public'] . '/site/asset/css/style.min.css');

}
