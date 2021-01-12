<?php


namespace mywishlist\controls;


use mywishlist\models\Item;
use mywishlist\models\Liste;
use mywishlist\vue\VueListe;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ControleurListe
{
    private $container;
    public function __construct($container)
    {
        $this->container=$container;
    }

    public function getListe(Request $rq, Response $rs, $args) {
        $liste = Liste::find($args)->first();
        $id=$args["uuid"];
        $items = Item::all()->where("liste_id","=",$id);
        $array = array($liste,$items);

        $vue = new VueListe($array,$this->container);
        $rs->getBody()->write($vue->render(1)) ;

        return $rs;
    }

    public function formCreer(Request $rq, Response $rs, $args){
        $vue = new vueListe([],$this->container);
        $rs->getBody()->write($vue->render(2));
        return $rs;
    }

    public function creer(Request $rq, Response $rs, $args){
        $post = $rq->getParsedBody() ;
        $titre       = filter_var($post['titre']       , FILTER_SANITIZE_STRING) ;
        $description = filter_var($post['description'] , FILTER_SANITIZE_STRING) ;
        $date = filter_var (preg_replace("([^0-9/] | [^0-9-])","",$post["dateexp"]));
        $l = new Liste();
        $l->titre = $titre;
        $l->description = $description;
        $l->expiration=$date;
        $l->save();
        $url_listes = $this->container->router->pathFor( 'aff_listes' ) ;
        return $rs->withRedirect($url_listes);
    }


}