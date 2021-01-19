<?php

namespace mywishlist\controls;

use mywishlist\vue\VueProfil;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use mywishlist\models\User;

class ControleurProfil {

    private $app;

    public function __construct($app) {
        $this->app = $app;
    }

    public function afficherProfil(Request $rq, Response $rs, $args){
        session_start();
        if (!isset($_SESSION['user'])) {
            return $rs->withRedirect($this->app->router->pathFor("racine"));
        }
        $vue = new VueProfil(null,$this->app);
        $rs->getBody()->write($vue->render(0));
        return $rs;
    }

    public function changerMotDePasse(Request $rq, Response $rs, $args){
        session_start();
        // If the user is not connected
        if (!isset($_SESSION['user'])) {
            return $rs->withRedirect($this->app->router->pathFor("profil"));
        }
        $old = filter_var($rq->getParsedBodyParam('old'), FILTER_SANITIZE_STRING);
        $new = filter_var($rq->getParsedBodyParam('new') , FILTER_SANITIZE_STRING);
        $user = User::all()->where('login', '=', $_SESSION['user']['login'])->first();
        if ($user != null) {
            if (password_verify($old, $user->pass)) {
                $user->pass = password_hash($new, PASSWORD_DEFAULT);
                $user->save();
                unset($_SESSION);
                session_destroy();
                return $rs->withRedirect($this->app->router->pathFor("pageConnexion"));
            }
        }
        return $rs->withRedirect($this->app->router->pathFor("profil"));
    }

}