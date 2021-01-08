<?php


namespace mywishlist\vue;

use mywishlist\vue\VueMenu;

class VueListe
{
    private $tab; // tab array PHP
    private $container;
    private $titre="";

    public function __construct($tab,$container) {
        $this->tab = $tab;
        $this->container=$container;

    }

    private function afficherListe() {
        $tab=$this->tab[0];

        $html = "{$tab["titre"]}, {$tab["description"]}";
        foreach($this->tab[1] as $item){
            $html .= "<li>{$item['nom']}, {$item['descr']}</li>";
        }
        $html = "<ul>$html</ul>";
        $this->titre = "Afficher Liste";
        return $html;
    }

    public function render( $select ) {

        switch ($select) {
            case(1):
                $content=$this->afficherListe();
                break;
            default:
                $content='';

        }

        return VueMenu::get($this->container,$content,$this->titre);
    }
}