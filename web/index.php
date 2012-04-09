<?php
require '../bootstrap.php';

use Roller\Plugin\RESTful\ResourceHandler;

$router = new Roller\Router( null, array( 
    // 'cache_id' => 'router_demo'
));

$restful = new Roller\Plugin\RESTful(array( 'prefix' => '/=' ));
$restful->registerResource( 'todos', 'LazyBone\Resource\TodoResource' );
$router->addPlugin($restful);

$router->add('/', 'LazyBone\Controller\IndexController:index' );

if( $r = $router->dispatch( isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/' ) ) {
    echo $r();
} else {
    die('Not found.');
}
