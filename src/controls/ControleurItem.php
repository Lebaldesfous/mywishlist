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
        $post = $rq->getParsedBody() ;
        $idliste = filter_var($post['id_liste'] , FILTER_SANITIZE_STRING);
        $liste = Liste::all()->where("no","=",$idliste)->first();
        if(is_null($liste)){
            $rs->getBody()->write("L'id_liste ne correspond à aucune liste");
            $url_acceuil = $this->container->router->pathFor('racine');
            return $rs->withRedirect($url_acceuil);
        }else{
            $nom       = filter_var($post['titre']       , FILTER_SANITIZE_STRING) ;
            $description = filter_var($post['description'] , FILTER_SANITIZE_STRING) ;
            $prix = filter_var($post['prix'],FILTER_SANITIZE_NUMBER_FLOAT);
            $url_page=filter_var($post['description'] , FILTER_SANITIZE_URL);
            $item = new Item();
            $item->liste_id=$idliste;
            $item->nom=$nom;
            $item->descr=$description;
            $item->url=$url_page;
            $item->tarif=$prix;
            $item->save();
        }

    }

}