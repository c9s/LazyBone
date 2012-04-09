<?php
namespace LazyBone\Controller;

class IndexController extends \Roller\Controller
{
    public function index()
    {
        return $this->render('index.php');
    }

    public function render($template,$args = array() )
    {
        extract( $args );
        require '../view/' . $template;
    }
}


