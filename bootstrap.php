<?php
require __DIR__ . '/vendor/pear/Universal/ClassLoader/BasePathClassLoader.php';
$loader = new \Universal\ClassLoader\BasePathClassLoader( array(
    __DIR__ . '/src',
    __DIR__ . '/model',
    __DIR__ . '/vendor/pear'
));
$loader->useIncludePath(true);
$loader->register();

use LazyRecord\ConfigLoader;
$config = new ConfigLoader;
$config->load( __DIR__  . '/.lazy.php');
$config->init();
