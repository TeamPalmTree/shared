<?php

// add views folder
Finder::instance()->add_path(__DIR__);

// add shared assets
Asset::instance()->add_path(DOCROOT.'assets/shared/js', 'js');
Asset::instance()->add_path(DOCROOT.'assets/shared/img', 'img');
Asset::instance()->add_path(DOCROOT.'assets/shared/css', 'css');

Autoloader::add_classes(array(
    'Controller_Base'   => __DIR__.'/classes/controller/base.php',
    'Controller_Standard'   => __DIR__.'/classes/controller/standard.php',
    'Helper'   => __DIR__.'/classes/helper.php',
    'MixingWheel'   => __DIR__.'/classes/mixingwheel.php',
    'Validation'   => __DIR__.'/classes/validation.php',
));