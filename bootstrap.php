<?php

// add views folder
Finder::instance()->add_path(__DIR__);

// add shared assets
Asset::instance()->add_path(DOCROOT.'assets/shared/js', 'js');
Asset::instance()->add_path(DOCROOT.'assets/shared/img', 'img');
Asset::instance()->add_path(DOCROOT.'assets/shared/css', 'css');

Autoloader::add_core_namespace('Standard');
Autoloader::add_core_namespace('Shared');

Autoloader::add_classes(array(
    'View'   => __DIR__.'/classes/view.php',
    'Controller_Shared'   => __DIR__.'/classes/controller/shared.php',
    'Controller_Standard'   => __DIR__.'/classes/controller/standard.php',
    'Shared\\Helper'   => __DIR__.'/classes/helper.php',
    'Shared\\Validation'   => __DIR__.'/classes/validation.php',
    'Standard\\Model\\Model_Site'   => __DIR__.'/classes/models/site.php',
    'Standard\\Model\\Model_Section'   => __DIR__.'/classes/models/section.php',
));