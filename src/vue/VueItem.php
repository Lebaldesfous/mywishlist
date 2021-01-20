<?php


namespace mywishlist\vue;

use mywishlist\vue\VueMenu;

class VueItem
{
    private $tab; // tab array PHP
    private $container;
    private $titre="";
    private $root;

    public function __construct($tab,$container) {
        $this->tab = $tab;
        $this->container=$container;
        $this->root=$container->router->pathFor('racine') ;
    }

    public function modifierItem(){
        $url_new_item= $this->container->router->pathFor('modifierItem',["uuid"=>$this->tab["uuid"],"id_item"=>$this->tab["id_item"]]);
        $html =<<<FIN
<form method="POST" action="$url_new_item">
	<label>Nom Item:<br> <input type="text" name="nom"/></label><br>
	<label>Description: <br><input type="text" name="description"/></label><br>
	<label>Prix <br><input type="text"  name="prix"/></label><br>	
	<label>Url page internet:<br><input type="text" name="url_page"/></label><br>
	<label>Url image:<br><input type="text" name="img"/></label><br>
	<button type="submit">Modifier l'item</button>
</form>	
FIN;
        $this->titre="Modifier Item";
        return $html;
    }

    private function afficherItem() {
        $tab=$this->tab;
        $imgurl = substr($tab['img'], 0, 4) == "http" ? $tab['img'] : "{$this->root}web/img/{$tab["img"]}";
        $divTitle = "
        <div class='item-title-desc'>
        <div>
        <h3 class='subtitle mb-2'>Titre : {$tab["nom"]}</h3>
        <p class='mb-3'>Description : {$tab["descr"]}</p>
        </div>
        <img src={$imgurl} />
        </div>";
        $div = "<div class='item-list'>
        <div class='item-desc'>
            <p>Affilié à la liste : {$tab['liste_id']}, au tarif de {$tab['tarif']}</p>
        </div>
        </div>";
        $html = "$divTitle<div class='separate-line'></div>$div";
        $this->titre = "Afficher item";
        return $html;
    }

    public function creerItem(){
        $url_new_item= $this->container->router->pathFor('creerItem',["uuid"=>$this->tab["uuid"]]);
        $html =<<<FIN
                <form method="POST" action="$url_new_item">
                    <label>Nom Item:<br> <input type="text" name="nom"/></label><br>
                    <label>Description: <br><input type="text" name="description"/></label><br>
                    <label>Prix <br><input type="text" name="prix"/></label><br>	
                    <label>Id Liste: <br><input type="text" name="id_liste"/></label><br>
                    <label>Url page internet:<br><input type="text" name="url_page"/></label><br>
                    <label>Url image:<br><input type="text" name="img"/></label><br>
                    <button type="submit" class="button is-link">Enregistrer l'item</button>
                </form>
FIN;
        $this->titre="Creer Item";
        return $html;
    }

    public function reserverItem(){
        $url_res_item = $this->container->router->pathFor('reserverItem', ["uuid"=>$this->tab["uuid"]]);
        $html = <<<FIN
                <form method = "POST" action = "$url_res_item">
                <label> Nom participant: <br> <input type = "text" name = "nom"/></label>
                <button type="submit" class="button is-link">Enregistrer l'item</button>
</form>
FIN;

        $this->titre = "Reserver Item";
        return $html;

    }


    public function render($select){
        switch($select){
            case 0:
                $content = $this->afficherItem();
                break;
            case 1:
                $content = $this->creerItem();
                break;
            case 2:
                $content=$this->modifierItem();
                break;
            case 3:
                $content=$this->supprimerItem();
                break;
            case 4:
                $content=$this->reserverItem();
                break;
            default:
                $content ='';
        }

        return VueMenu::get($this->container,$content,$this->titre);
    }
}