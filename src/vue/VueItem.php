<?php


namespace mywishlist\vue;

use mywishlist\vue\VueMenu;

class VueItem
{
    private $tab; // tab array PHP
    private $container;
    private $titre="";

    public function __construct($tab,$container) {
        $this->tab = $tab;
        $this->container=$container;

    }

    public function modifierItem(){
        $url_new_item= $this->container->router->pathFor('modifierItem',["uuid"=>$this->tab["uuid"],"id_item"=>$this->tab["id_item"]]);
        $html =<<<FIN
<form method="POST" action="$url_new_item">
	<label>Nom Item:<br> <input type="text" name="nom"/></label><br>
	<label>Description: <br><input type="text" name="description"/></label><br>
	<label>Prix <br><input type="text"  name="prix"/></label><br>	
	<label>Url page internet:<br><input type="text" name="url_page"/></label><br>
	<button type="submit">Modifier l'item</button>
</form>	
FIN;
        $this->titre="Modifier Item";
        return $html;
    }

    public function creerItem(){
        $url_new_item= $this->container->router->pathFor('creerItem',["uuid"=>$this->tab["uuid"]]);
        $html =<<<FIN
<form method="POST" action="$url_new_item">
	<label>Nom Item:<br> <input type="text" name="nom"/></label><br>
	<label>Description: <br><input type="text" name="description"/></label><br>
	<label>Prix <br><input type="number" step="0.01" name="prix"/></label><br>	
	<label>Id Liste: <br><input type="text" name="id_liste"/></label><br>
	<label>Url page internet:<br><input type="text" name="url_page"/></label><br>
	<button type="submit">Enregistrer l'item</button>
</form>	
FIN;
        $this->titre="Creer Item";
        return $html;
    }

    public function render($select){
        switch($select){
            case 1:
                $content = $this->creerItem();
                break;
            case 2:
                $content=$this->modifierItem();
                break;
            case 3:
                $content=$this->supprimerItem();
                break;
            default:
                $content ='';
        }

        return VueMenu::get($this->container,$content,$this->titre);
    }
}