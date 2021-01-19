<?php


namespace mywishlist\controls;


use mywishlist\models\Item;
use mywishlist\models\Liste;
use mywishlist\vue\VueItem;
use mywishlist\vue\VueMenu;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ControleurItem {

    private $app;

    public function __construct($app) {
        $this->app = $app;
    }

    public function afficherItem(Request $rq, Response $rs, $args){
        $id=$args["id_item"];
        $item = Item::find($id);
        $vue = new VueItem($item,$this->app);
        $rs->getBody()->write($vue->render(0)) ;

        return $rs;
    }

    public function formCreerItem(Request $rq, Response $rs, $args){
        if (session_status() == PHP_SESSION_NONE) {
            $url_connexion= $this->app->router->pathFor('connexion');
            return $rs->withRedirect($url_connexion);
        }else{
            $vue = new VueItem($args,$this->app);
            $rs->getBody()->write($vue->render(1));
            return $rs;
        }

    }

    public function formReserverItem(Request $rq, Response $rs, $args){
        if(session_status() == PHP_SESSION_NONE){
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
        $post = $rq->getParsedBody();
        $idliste = filter_var($post['id_liste'] , FILTER_SANITIZE_STRING);
        $liste = Liste::all()->where("no","=",$idliste)->first();
        if(is_null($liste)){
            $rs->getBody()->write(VueMenu::get($this->app,"L'id_liste ne correspond à aucune liste","Erreur Creation"));
            return $rs;
        }else{
            $nom       = filter_var($post['nom']       , FILTER_SANITIZE_STRING) ;
            $description = filter_var($post['description'] , FILTER_SANITIZE_STRING) ;
            $prix = filter_var($post['prix'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
            $url_page=filter_var($post['url_page'] , FILTER_SANITIZE_URL);
            $url_image = filter_var($post['img'], FILTER_SANITIZE_URL);
            $item = new Item();
            $item->liste_id=$idliste;
            $item->nom=$nom;
            $item->descr=$description;
            $item->url=$url_page;
            $item->tarif=$prix;
            $item->img=$url_image;
            $item->save();
            $url_listes = $this->app->router->pathFor( 'racine' ) ;
            return $rs->withRedirect($url_listes);
        }

    }

    public function formModifierItem(Request $rq, Response $rs, $args){
        $vue = new VueItem($args,$this->app);
        $rs->getBody()->write($vue->render(2));
        return $rs;
    }

    public function modifierItem(Request $rq, Response $rs, $args){
        $post = $rq->getParsedBody();
        $idliste = filter_var($args['id_liste'] , FILTER_SANITIZE_STRING);
        $iditem= filter_var($args['id_item'] , FILTER_SANITIZE_STRING);
        $item = Item::all()->where("id","=",$iditem,"liste_id","=",$idliste)->first();

        if(is_null($item)){
            $rs->getBody()->write("l'item n'existe pas ");
            $url_accueil = $this->app->router->pathFor('racine');
            return $rs->withRedirect($url_accueil);
        }else{
            $nom       = filter_var($post['nom']       , FILTER_SANITIZE_STRING) ;
            $description = filter_var($post['description'] , FILTER_SANITIZE_STRING) ;
            $prix = filter_var($post['prix'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
            $url_page=filter_var($post['url_page'] , FILTER_SANITIZE_URL);
            $url_image = filter_var($post['img'], FILTER_SANITIZE_URL);
            $item->liste_id=$idliste;
            $item->nom=$nom;
            $item->descr=$description;
            $item->url=$url_page;
            $item->tarif=$prix;
            $item->img=$url_image;
            $item->save();
            $url_listes = $this->app->router->pathFor( 'racine' ) ;
            return $rs->withRedirect($url_listes);
        }

    }

    public function supprimerItem(Request $rq, Response $rs, $args){
        $post = $rq->getParsedBody();
        $idliste = filter_var($args['id_liste'] , FILTER_SANITIZE_STRING);
        $iditem= filter_var($args['id_item'] , FILTER_SANITIZE_STRING);
        $item = Item::all()->where("id","=",$iditem,"liste_id","=",$idliste)->first();
        if(is_null($item)){
            $rs->getBody()->write("l'item n'existe pas ");
            $url_accueil = $this->app->router->pathFor( 'racine' ) ;
            return $rs->withRedirect($url_accueil);
        }else{
           $item->delete();
           $url_accueil = $this->app->router->pathFor( 'racine' ) ;
           return $rs->withRedirect($url_accueil);
        }

    }

}