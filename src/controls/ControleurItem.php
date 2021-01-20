<?php


namespace mywishlist\controls;


use mywishlist\models\Item;
use mywishlist\models\Liste;
use mywishlist\vue\VueItem;
use mywishlist\vue\VueListe;
use mywishlist\vue\VueMenu;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ControleurItem {

    private $app;

    public function __construct($app) {
        $this->app = $app;
    }

    public function afficherItem(Request $rq, Response $rs, $args){
        $liste = Liste::all()->where("token","=",$args["uuid"])->first();
        if (is_null($liste)) {
            $url= $this->container->router->pathFor('racine');
            return $rs->withRedirect($url);
        }
        $id=$args["id_item"];
        $item = Item::all()->where("id", "=", $id, "liste_id", "=", $liste->no)->first();
        $array=array($liste, $item);
        $vue = new VueItem($array,$this->app);
        $rs->getBody()->write($vue->render(0)) ;

        return $rs;
    }

    public function formTokenListe(Request $rq, Response $rs, $args) {
        session_start();
        if (is_null($_SESSION['user'])) {
            $url_connexion= $this->app->router->pathFor('connexion');
            return $rs->withRedirect($url_connexion);
        }else {
            $vue = new VueItem([], $this->app);
            $rs->getBody()->write($vue->render(1));
            return $rs;
        }
    }

    public function tokenListe(Request $rq, Response $rs, $args){
        $post =$rq->getParsedBody();
        $url_item=$this->app->router->pathFor('formItem',["uuid"=>$post["token"]]);
        return $rs->withRedirect($url_item);

    }

    public function formCreerItem(Request $rq, Response $rs, $args){
        session_start();
        if (is_null($_SESSION['user'])) {
            $url_connexion= $this->app->router->pathFor('connexion');
            return $rs->withRedirect($url_connexion);
        }else{
            $vue = new VueItem($args,$this->app);
            $rs->getBody()->write($vue->render(5));
            return $rs;
        }

    }

    public function formReserverItem(Request $rq, Response $rs, $args){
        session_start();
        if(is_null($_SESSION['user'])){
            $url_connexion= $this->app->router->pathFor('connexion');
            return $rs->withRedirect($url_connexion);
        }else{
            $vue = new VueItem($args,$this->app);
            $rs->getBody()->write($vue->render(1));
            return $rs;
        }
    }

    public function reserverItem(Request $rq, Response $rs, $args){
        $post = $rq->getParsedBody();
        $idliste = filter_var($args['id_liste'] , FILTER_SANITIZE_STRING);
        $iditem= filter_var($args['id_item'] , FILTER_SANITIZE_STRING);
        $item = Item::all()->where("id","=",$iditem,"liste_id","=",$idliste)->first();

        $id_user = filter_var($post['iduser'], FILTER_SANITIZE_NUMBER_INT);
        if($item->iduser == NULL){
            $item->iduser=$id_user;
            $item->save();
            $url_listes = $this->app->router->pathFor( 'racine' ) ;
            return $rs->withRedirect($url_listes);
        }else{
            $rs->getBody()->write(VueMenu::get($this->app,"L'item a déjà été réservé","Erreur Réservation"));
            return $rs;
        }

    }

    public function creerItem(Request $rq, Response $rs, $args){
        session_start();
        if (is_null($_SESSION['user'])) {
            $url_connexion= $this->app->router->pathFor('connexion');
            return $rs->withRedirect($url_connexion);
        }else {
            $post = $rq->getParsedBody();
            $token = $args["uuid"];
            $liste = Liste::all()->where("token", "=", $token)->first();
            if (is_null($liste)) {
                $rs->getBody()->write(VueMenu::get($this->app, "L'id_liste ne correspond à aucune liste", "Erreur Creation"));
                return $rs;
            } else {
                $nom = filter_var($post['nom'], FILTER_SANITIZE_STRING);
                $description = filter_var($post['description'], FILTER_SANITIZE_STRING);
                $prix = filter_var($post['prix'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $url_page = filter_var($post['url_page'], FILTER_SANITIZE_URL);
                $url_image = filter_var($post['img'], FILTER_SANITIZE_URL);
                $item = new Item();
                $item->liste_id = $liste->no;
                $item->nom = $nom;
                $item->descr = $description;
                $item->url = $url_page;
                $item->tarif = $prix;
                $item->img = $url_image;
                $item->iduser=$_SESSION['user']['id'];
                $item->save();
                $item = Item::all()->where("nom","=",$nom,"liste_id","=",$liste->no,"descr","=",$description)->first();
                $url_token = $this->app->router->pathFor('aff_item',["uuid"=>$token,"id_item"=>$item->id]);
                return $rs->withRedirect($url_token);
            }
        }
    }

    public function formModifierItem(Request $rq, Response $rs, $args){
        $vue = new VueItem($args,$this->app);
        $rs->getBody()->write($vue->render(2));
        return $rs;
    }

    public function modifierItem(Request $rq, Response $rs, $args){
        session_start();
        if (is_null($_SESSION['user'])) {
            $url_connexion= $this->app->router->pathFor('connexion');
            return $rs->withRedirect($url_connexion);
        }else {
            $post = $rq->getParsedBody();
            $idliste = filter_var($args['id_liste'], FILTER_SANITIZE_STRING);
            $iditem = filter_var($args['id_item'], FILTER_SANITIZE_STRING);
            $item = Item::all()->where("id", "=", $iditem, "liste_id", "=", $idliste)->first();
            session_start();
            if (is_null($item)) {
                $rs->getBody()->write("l'item n'existe pas ");
                $url_accueil = $this->app->router->pathFor('racine');
                return $rs->withRedirect($url_accueil);
            } else {
                $nom = filter_var($post['nom'], FILTER_SANITIZE_STRING);
                $description = filter_var($post['description'], FILTER_SANITIZE_STRING);
                $prix = filter_var($post['prix'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $url_page = filter_var($post['url_page'], FILTER_SANITIZE_URL);
                $url_image = filter_var($post['img'], FILTER_SANITIZE_URL);
                $item->liste_id = $idliste;
                $item->nom = $nom;
                $item->descr = $description;
                $item->url = $url_page;
                $item->tarif = $prix;
                $item->img = $url_image;
                $item->save();
                $url_listes = $this->app->router->pathFor('racine');
                return $rs->withRedirect($url_listes);
            }
        }
    }

    public function supprimerItem(Request $rq, Response $rs, $args){
        session_start();
        if (is_null($_SESSION['user'])) {
            $url_connexion= $this->app->router->pathFor('connexion');
            return $rs->withRedirect($url_connexion);
        }else {
            $post = $rq->getParsedBody();
            $idliste = filter_var($args['id_liste'], FILTER_SANITIZE_STRING);
            $iditem = filter_var($args['id_item'], FILTER_SANITIZE_STRING);
            $item = Item::all()->where("id", "=", $iditem, "liste_id", "=", $idliste)->first();
            if (is_null($item)) {
                $rs->getBody()->write("l'item n'existe pas ");
                $url_accueil = $this->app->router->pathFor('racine');
                return $rs->withRedirect($url_accueil);
            } else {
                $item->delete();
                $url_accueil = $this->app->router->pathFor('racine');
                return $rs->withRedirect($url_accueil);
            }
        }
    }

}