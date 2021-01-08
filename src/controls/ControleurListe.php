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

        $url_racine = $this->container->router->pathFor( 'racine' ) ;
        return $rs->withRedirect($url_racine);
    }


}