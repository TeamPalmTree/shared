<?php

// add views folder
Finder::instance()->add_path(__DIR__);

Autoloader::add_classes(array(
    'Controller_Shared'   => __DIR__.'/classes/controller/shared.php',
    'Helper'   => __DIR__.'/classes/helper.php',
));