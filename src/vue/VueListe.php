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

    private function afficherListes() {
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
        $divTitle = "<h3 class='subtitle mb-2'>Titre : {$tab["titre"]}</h3><p class='mb-3'>Description : {$tab["description"]}</p>";
        $li = "";
        foreach($this->tab[1] as $item){
            $url_res_item = $this->container->router->pathFor('aff_item', ["uuid"=>$this->tab[0]["no"], "id_item"=>$item["id"]]);
            $state=$item['etat'] == 0 ? 'Non réservé' : 'Réservé';
            $li .= "<a class='item-list' href=$url_res_item>
            <div class='item-desc'>
                <img src='/mywishlist/web/img/{$item['img']}'/>
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
	<label>Description: <br><input type="text" name="description"/></label><br>
	<Label>Date d'expiration:<br><input type="date" name="dateexp"/> </Label><br>
	<button type="submit">Enregistrer la liste</button>
</form>	
FIN;
        $this->titre="Creer Liste";
        return $html;
    }

    private function modifierListe(){
        $token =$this->tab["token"];
        $url_modifier_liste= $this->container->router->pathFor("modifierListe",["token"=>$token]);
        $html=<<<FIN
<form method="POST" action="$url_modifier_liste">
	<label>Titre:<br> <input type="text" name="titre"/></label><br>
	<label>Description: <br><input type="text" name="description"/></label><br>
	<Label>Date d'expiration:<br><input type="date" name="dateexp"/> </Label><br>
	<button type="submit">Modifier la liste</button>
</form>	
FIN;
        $this->titre="Modifier Liste";
        return $html;
    }

    public function render( $select ) {

        switch ($select) {
            case(0):
                $content=$this->afficherListes();
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