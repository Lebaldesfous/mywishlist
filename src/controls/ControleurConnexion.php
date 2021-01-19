<?php

namespace mywishlist\controls;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use mywishlist\vue\VueConnexion;

class ControleurConnexion {

    private $app;

    public function __construct($app) {
        $this->app = $app;
    }

    public function pageInscription(Request $rq, Response $res, $args) {
        $vue= new VueConnexion(null,$this->app);
		$res->getBody()->write($vue->render(1)) ;
		return $res;
    }

    public function pageConnexion(Request $rq, Response $res, $args) {
        $vue= new VueConnexion(null,$this->app);
		$res->getBody()->write($vue->render(2)) ;
		return $res;
    }

    public function inscription(Request $rq, Response $res, $args) {

        session_start();
        $post = $rq->getParsedBody() ;
        $login = filter_var($post['username'], FILTER_SANITIZE_STRING);
        $password = filter_var($post['password'] , FILTER_SANITIZE_STRING);
        $user = User::where('login','=',$login)->first();
        if ($user != null) {
            $u = new User();
            $u->login=$login;
            $u->password=password_hash($password, PASSWORD_DEFAULT);
            $u->save();
            $_SESSION->user = $u;
        }
        return $res;

    }

    public function connexion(Request $rq, Response $res, $args) {

        session_start();
        $post = $rq->getParsedBody() ;
        $login = filter_var($post['username'], FILTER_SANITIZE_STRING);
        $password = filter_var($post['password'] , FILTER_SANITIZE_STRING);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = User::where('login', '=', $login)->where("password", "=", $hashedPassword)->first();
        if ($user != null) {
            $_SESSION->user = $user;
        }
        return $res;

    }

}