<?php

namespace mywishlist\controls;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use mywishlist\vue\VueConnexion;
use mywishlist\models\User;

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

    public function deconnect(Request $rq, Response $res, $args) {
        session_start();
        unset($_SESSION['user']);
        session_destroy();
		$redirect = $this->app->router->pathFor("racine");
        return $res->withRedirect($redirect);
    }

    public function inscription(Request $rq, Response $res, $args) {

        session_start();
        $login = filter_var($rq->getParsedBodyParam('username'), FILTER_SANITIZE_STRING);
        $password = filter_var($rq->getParsedBodyParam('password') , FILTER_SANITIZE_STRING);
        $user = User::all()->where('login','=',$login)->first();
        if ($user == null) {
            $u = new User();
            $u->login=$login;
            $u->pass=password_hash($password, PASSWORD_DEFAULT);
            $u->save();
            $u=User::all()->where("login","=",$login)->first();
            $_SESSION['user'] = $u;
            return $res->withRedirect($this->app->router->pathFor("racine"));
        }
        $redirect = $this->app->router->pathFor("pageConnexion");
        return $res->withRedirect($redirect);

    }

    public function connexion(Request $rq, Response $res, $args) {

        session_start();
        $login = filter_var($rq->getParsedBodyParam('username'), FILTER_SANITIZE_STRING);
        $password = filter_var($rq->getParsedBodyParam('password') , FILTER_SANITIZE_STRING);
        $user = User::all()->where('login', '=', $login)->first();
        if ($user != null) {
            if (password_verify($password, $user->pass)) {
                unset($user->pass);
                $_SESSION['user'] = $user;
                return $res->withRedirect($this->app->router->pathFor("racine"));
            }
        }
        $redirect = $this->app->router->pathFor("pageConnexion");
        return $res->withRedirect($redirect);

    }

}