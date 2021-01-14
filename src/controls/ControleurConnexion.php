<?php

namespace mywishlist\controls;

class ControleurConnexion {

    public static function inscription(Request $req, Response $res, $args) {

        session_start();
        $info = $rq->getParsedBody() ;
        $login = filter_var($post['login'], FILTER_SANITIZE_STRING);
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

    public static function connexion(Request $req, Response $res, $args) {

        session_start();
        $info = $rq->getParsedBody() ;
        $login = filter_var($post['login'], FILTER_SANITIZE_STRING);
        $password = filter_var($post['password'] , FILTER_SANITIZE_STRING);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = User::where('login', '=', $login)->where("password", "=", $hashedPassword)->first();
        if ($user != null) {
            $_SESSION->user = $user;
        }
        return $res;

    }

}