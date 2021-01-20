<?php


namespace mywishlist\controls;


use Doctrine\Inflector\Rules\Word;
use mywishlist\models\Item;
use mywishlist\models\Liste;
use mywishlist\vue\VueListe;
use mywishlist\vue\VueMenu;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ControleurListe
{
    private $container;
    public function __construct($container)
    {
        $this->container=$container;
    }

    public function accueil(Request $rq, Response $rs, $args){
        $rs->getBody()->write(VueMenu::get($this->container,'',"accueil"));
        return $rs;
    }



    public function getListe(Request $rq, Response $rs, $args) {
        $liste = Liste::all()->where("token","=",$args["uuid"])->first();
        $id=$liste->no;
        $items = Item::all()->where("liste_id","=",$id);
        $array = array($liste,$items);
        $vue = new VueListe($array,$this->container);
        $rs->getBody()->write($vue->render(1)) ;
        return $rs;
    }

    public function afficherListes(Request $rq, Response $rs, $args) {
        $listes = Liste::all();
        $vue = new VueListe($listes,$this->container);
        $rs->getBody()->write($vue->render(0)) ;

        return $rs;
	}

    public function formCreer(Request $rq, Response $rs, $args){
        session_start();
        if (is_null($_SESSION['user'])) {
            $url_connexion= $this->container->router->pathFor('connexion');
            return $rs->withRedirect($url_connexion);
        }else {
            $vue = new vueListe([], $this->container);
            $rs->getBody()->write($vue->render(2));
            return $rs;
        }
    }

    public function creer(Request $rq, Response $rs, $args){
        session_start();
        if(!isset($_SESSION['user'])){
            $url_connexion= $this->container->router->pathFor('connexion');
            return $rs->withRedirect($url_connexion);
        }else{
            $post = $rq->getParsedBody() ;
            $titre       = filter_var($post['titre']       , FILTER_SANITIZE_STRING) ;
            $description = filter_var($post['description'] , FILTER_SANITIZE_STRING) ;
            $date = filter_var (preg_replace("([^0-9/] | [^0-9-])","",$post["dateexp"]));
            $l = new Liste();
            $l->titre = $titre;
            $l->description = $description;
            $l->expiration=$date;
            $bytes = random_bytes(8);
            $l->token = bin2hex($bytes);
            $l->user_id=$_SESSION['user']['id'];
            $l->save();
            $l=Liste::all()->where("titre","=",$titre,"description","=",$description,"expiration","=",$date,"user_id","=",$_SESSION['user']['id'])->first();
            var_dump($l);
            $url_liste = $this->container->router->pathFor( 'aff_liste',["uuid"=>$l->token] ) ;
            return $rs->withRedirect($url_liste);
        }


    }

    public function formModifierListe(Request $rq, Response $rs, $args){
        session_start();
        if (is_null($_SESSION['user'])) {
            $url_connexion= $this->app->router->pathFor('connexion');
            return $rs->withRedirect($url_connexion);
        }else {
            $vue = new vueListe($args, $this->container);
            $rs->getBody()->write($vue->render(3));
            return $rs;
        }
    }

    public function modifierListe(Request $rq, Response $rs, $args){
        session_start();
        if(!isset($_SESSION['user'])){
            $url_connexion= $this->container->router->pathFor('connexion');
            return $rs->withRedirect($url_connexion);
        }else {
            $token = $args['token'];
            $liste = Liste::all()->where("token", "=", $token);
            session_start();
            if (is_null($liste)) {
                $rs->getBody()->write("Le token ne correspond à aucune liste");
                $url_accueil = $this->container->router->pathFor('racine');
                return $rs->withRedirect($url_accueil);
            } else {
                $post = $rq->getParsedBody();
                $titre = filter_var($post['titre'], FILTER_SANITIZE_STRING);
                $description = filter_var($post['description'], FILTER_SANITIZE_STRING);
                $date = filter_var(preg_replace("([^0-9/] | [^0-9-])", "", $post["dateexp"]));
                $liste->titre = $titre;
                $liste->description = $description;
                $today = date('d-m-Y');
                if ($today <= $date) {
                    $liste->expiration = $date;
                    $liste->save();
                }
                $url_listes = $this->container->router->pathFor('aff_liste', ["uuid" => $liste->no]);
                return $rs->withRedirect($url_listes);
            }
        }
    }

    public function supprimerListe(Request $rq, Response $rs, $args){
        session_start();
        if(!isset($_SESSION['user'])){
            $url_connexion= $this->container->router->pathFor('connexion');
            return $rs->withRedirect($url_connexion);
        }else {
            $token = $args['token'];
            $liste = Liste::all()->where("token", "=", $token);
            session_start();
            if (is_null($liste)) {
                $rs->getBody()->write("Le token ne correspond à aucune liste");
                $url_accueil = $this->container->router->pathFor('racine');
                return $rs->withRedirect($url_accueil);
            } else {
                if (is_null($liste)) {
                    $rs->getBody()->write("La liste n'existe pas ");
                    $url_accueil = $this->app->router->pathFor('racine');
                    return $rs->withRedirect($url_accueil);
                } else {
                    $liste->delete();
                    $url_accueil = $this->app->router->pathFor('racine');
                    return $rs->withRedirect($url_accueil);
                }

            }
        }
    }


}