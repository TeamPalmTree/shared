<?php

// add views folder
Finder::instance()->add_path(__DIR__);

// add shared assets
Asset::instance()->add_path(DOCROOT.'shared/js', 'js');
Asset::instance()->add_path(DOCROOT.'shared/img', 'img');
Asset::instance()->add_path(DOCROOT.'shared/css', 'css');

Autoloader::add_classes(array(
    'Controller_Shared'   => __DIR__.'/classes/controller/shared.php',
    'Helper'   => __DIR__.'/classes/helper.php',
));