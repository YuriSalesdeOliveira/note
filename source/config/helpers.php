<?php

function assets(string $path): string {

    return SITE['root'] . "/{$path}";

}