<?php


namespace mywishlist\controls;


use mywishlist\models\Item;
use mywishlist\models\Liste;
use mywishlist\vue\VueItem;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ControleurItem {

    private $app;

    public function __construct($app) {
        $this->app = $app;
    }

    public function ajouterImage(Request $rq, Response $rs, $args){

    }

    public function formCreerItem(Request $rq, Response $rs, $args){
        $vue = new VueItem($args,$this->app);
        $rs->getBody()->write($vue->render(1));
        return $rs;
    }

    public function creerItem(Request $rq, Response $rs, $args){
        $post = $rq->getParsedBody();
        $idliste = filter_var($post['id_liste'] , FILTER_SANITIZE_STRING);
        $liste = Liste::all()->where("no","=",$idliste)->first();
        if(is_null($liste)){
            $rs->getBody()->write("L'id_liste ne correspond à aucune liste");
            $url_acceuil = $this->app->router->pathFor('racine');
            return $rs->withRedirect($url_acceuil);
        }else{
            $nom       = filter_var($post['nom']       , FILTER_SANITIZE_STRING) ;
            $description = filter_var($post['description'] , FILTER_SANITIZE_STRING) ;
            $prix = filter_var($post['prix'],FILTER_SANITIZE_NUMBER_FLOAT);
            $url_page=filter_var($post['url_page'] , FILTER_SANITIZE_URL);
            $item = new Item();
            $item->liste_id=$idliste;
            $item->nom=$nom;
            $item->descr=$description;
            $item->url=$url_page;
            $item->tarif=$prix;
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
            $url_acceuil = $this->app->router->pathFor('racine');
            return $rs->withRedirect($url_acceuil);
        }else{
            $nom       = filter_var($post['nom']       , FILTER_SANITIZE_STRING) ;
            $description = filter_var($post['description'] , FILTER_SANITIZE_STRING) ;
            $prix = filter_var($post['prix'],FILTER_SANITIZE_NUMBER_FLOAT);
            $url_page=filter_var($post['url_page'] , FILTER_SANITIZE_URL);
            $item->liste_id=$idliste;
            $item->nom=$nom;
            $item->descr=$description;
            $item->url=$url_page;
            $item->tarif=$prix;
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
            $url_acceuil = $this->app->router->pathFor( 'racine' ) ;
            return $rs->withRedirect($url_acceuil);
        }else{
           $item->delete();
           $url_acceuil = $this->app->router->pathFor( 'racine' ) ;
           return $rs->withRedirect($url_acceuil);
        }

    }

}