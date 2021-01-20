<?php


namespace mywishlist\vue;

use mywishlist\vue\VueMenu;

class VueListe
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

    private function afficherListesPubliques() {
        $li = "";
        foreach($this->tab as $liste){
            $li .= "<div class='item-list'>
                <p>{$liste['titre']}</p>
                <p>{$liste['description']}</p>
                <p>{$liste['expiration']}</p>
            </div>
            <div class='separate-line bg-blue w-15'></div>";
        }
        $html = "<div class='separate-line'></div><ul>$li</ul>";
        $this->titre = "Afficher listes";
        return $html;
    }

    private function afficherListe() {
        $tab=$this->tab[0];
        $divTitle = "<h3 class='subtitle mb-2'>Titre : {$tab["titre"]}</h3><p class='mb-3'>Description : {$tab["description"]}</p><br><p>Voici le token de modification de la liste : {$tab["token"]}</p>";
        $li = "";
        foreach($this->tab[1] as $item){
            $url_res_item = $this->container->router->pathFor('aff_item', ["uuid"=>$this->tab[0]["token"], "id_item"=>$item["id"]]);
            $state=$item['etat'] == 0 ? 'Non réservé' : 'Réservé';
            $imgurl = substr($item['img'], 0, 4) == "http" ? $item['img'] : "{$this->root}web/img/{$item["img"]}";
            $li .= "<a class='item-list' href=$url_res_item>
            <div class='item-desc'>
                <img src={$imgurl} />
                <p>{$item['nom']}, {$item['descr']}</p>
            </div>
                <p>{$state}</p>
            </a>";
        }
        $html = "$divTitle<div class='separate-line'></div><ul>$li</ul>";
        $this->titre = "Afficher liste";
        return $html;
    }

    private function creerListe(){
        $url_new_liste= $this->container->router->pathFor("creerListe");
        $html=<<<FIN
<form method="POST" action="$url_new_liste">
	<label>Titre:<br> <input type="text" name="titre"/></label><br>
	<label>Description: <br><textarea type="text" name="description" rows="5" cols="33"></textarea></label><br>
    <Label>Date d'expiration:<br><input type="date" name="dateexp"/></Label><br>
    <Label>Rendre publique:<br><input type="checkbox" name="isPublic" value="1"/></Label><br>
	<button type="submit">Enregistrer la liste</button>
</form>	
FIN;
        $this->titre="Creer Liste";
        return $html;
    }

    private function modifierListe(){
        $url_modifier_liste= $this->container->router->pathFor("modifierListe");
        $html=<<<FIN
<form method="POST" action="$url_modifier_liste">
    <label>Token de la liste:<br> <input type="text" name="token"/></label><br>
	<label>Titre:<br> <input type="text" name="titre"/></label><br>
	<label>Description: <br><textarea type="text" name="description" rows="5" cols="33"></textarea></label><br>
    <Label>Date d'expiration:<br><input type="date" name="dateexp"/></Label><br>
    <Label>Rendre publique:<br><input type="checkbox" name="isPublic" value="1"/></Label><br>
	<button type="submit">Modifier la liste</button>
</form>	
FIN;
        $this->titre="Modifier Liste";
        return $html;
    }

    public function render( $select ) {

        switch ($select) {
            case(0):
                $content=$this->afficherListesPubliques();
                break;
            case(1):
                $content=$this->afficherListe();
                break;
            case(2):
                $content =$this->creerListe();
                break;
            case(3):
                $content=$this->modifierListe();
                break;
            default:
                $content='';

        }

        return VueMenu::get($this->container,$content,$this->titre);
    }
}