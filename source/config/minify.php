<?php

use MatthiasMullie\Minify\CSS;
use MatthiasMullie\Minify\JS;

if (DEVELOPMENT) {

    /**
     * SITE
     * css
     */

    $minCSS = new CSS();
        $minCSS->add(PATH['view'] . '/site/asset/css/global.css');
    $minCSS->add(PATH['view'] . '/site/asset/css/reset.css');
    $minCSS->add(PATH['view'] . '/site/asset/css/colors.css');
    $minCSS->add(PATH['view'] . '/site/asset/css/message.css');
    $minCSS->add(PATH['view'] . '/site/asset/css/main.css');

    $minCSS->minify(PATH['public'] . '/site/asset/css/main.min.css');

    $minCSS = new CSS();
        $minCSS->add(PATH['view'] . '/site/asset/css/global.css');
    $minCSS->add(PATH['view'] . '/site/asset/css/reset.css');
    $minCSS->add(PATH['view'] . '/site/asset/css/colors.css');
    $minCSS->add(PATH['view'] . '/site/asset/css/message.css');
    $minCSS->add(PATH['view'] . '/site/asset/css/card_form.css');
    $minCSS->minify(PATH['public'] . '/site/asset/css/forms.min.css');

    /**
     * SITE
     * js
     */

    $minJS = new JS();
    $minJS->add(PATH['view'] . '/site/asset/js/modal.js');
    $minJS->add(PATH['view'] . '/site/asset/js/changeModalColor.js');
    $minJS->minify(PATH['public'] . '/site/asset/js/modal.min.js');

    $minJS = new JS();
    $minJS->add(PATH['view'] . '/site/asset/js/dropdown.js');
    $minJS->minify(PATH['public'] . '/site/asset/js/dropdown.min.js');


    $minJS = new JS();
    $minJS->add(PATH['view'] . '/site/asset/js/note.js');
    $minJS->minify(PATH['public'] . '/site/asset/js/note.min.js');


    $minJS = new JS();
    $minJS->add(PATH['view'] . '/site/asset/js/toggleForms.js');
    $minJS->minify(PATH['public'] . '/site/asset/js/toggleForms.min.js');

    


    



}
