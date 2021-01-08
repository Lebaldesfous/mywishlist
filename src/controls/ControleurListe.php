<?php


namespace mywishlist\controls;


use mywishlist\models\Item;
use mywishlist\models\Liste;
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
        $id=$args["id"];
        $items = Item::all()->where("liste_id","=",$id);
        $array = array($liste,$items);

        $vue = new \mywishlist\vue\VueListe($array,$this->container);
        $rs->getBody()->write($vue->render(1)) ;

        return $rs;
    }


}