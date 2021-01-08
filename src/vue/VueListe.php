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
            case(2):
                $url_new_liste= $this->container->router->pathFor("creer_liste");
                $content =<<<FIN
<form method="POST" action="$url_new_liste">
	<label>Titre:<br> <input type="text" name="titre"/></label><br>
	<label>Description: <br><input type="text" name="description"/></label><br>
	<button type="submit">Enregistrer la liste</button>
</form>	
FIN;
                $this->titre="Creer Liste";
                break;
            default:
                $content='';

        }

        return VueMenu::get($this->container,$content,$this->titre);
    }
}