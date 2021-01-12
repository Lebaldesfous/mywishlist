<?php


namespace mywishlist\controls;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ControleurItem {

    private $app;

    public function __construct($app) {
        $this->app = $app;
    }

    public function ajouterImage(Request $rq, Response $rs, $args){

    }

}