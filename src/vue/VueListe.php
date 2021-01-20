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
        $url_sup_item=$this->container->router->pathFor('supprimerListe', ["uuid"=>$this->tab[0]["token"]]);
        $divTitle = "<div class='list-desc-flex'><div><h3 class='subtitle mb-2'>Titre : {$tab["titre"]}</h3><p class='mb-3'>Description : {$tab["description"]}</p><br><p>Voici le token de modification de la liste : {$tab["token"]}</p></div><form method='POST' action='$url_sup_item'><button class='button is-warning' type='submit'>Supprimer</button></form></div>";
        $li = "";
        foreach($this->tab[1] as $item){
            $url_item = $this->container->router->pathFor('aff_item', ["uuid"=>$this->tab[0]["token"], "id_item"=>$item["id"]]);
            $url_res_item = $this->container->router->pathFor('formReserverItem', ["uuid"=>$this->tab[0]["token"], "id_item"=>$item["id"]]);
            $state=$item['etat'] == 0 ? 'Non réservé' : 'Réservé';
            $imgurl = substr($item['img'], 0, 4) == "http" ? $item['img'] : "{$this->root}web/img/{$item["img"]}";
            $li .= "<a class='item-list' href=$url_item>
            <div class='item-desc'>
                <img src={$imgurl} />
                <p>{$item['nom']}, {$item['descr']}</p>
            </div>
            <div class='div-reservation'>
                <p>{$state}</p>
                <form action={$url_res_item}>
                    <input class='button is-primary ml-3' type='submit' value='Réservation' />
                </form>
            </div>
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

    private function partagerListe(){
        $url_liste= $this->container->router->pathFor("aff_liste", ["uuid"=>$this->tab["uuid"]]);
        $url=$_SERVER['HTTP_HOST'];
        $url.=$_SERVER['REQUEST_URI'];
        $url=substr($url, 0, -8);
        $div = "<div class='share-link'><label>Lien de la liste:<br><input type='url' name='link' value={$url} class='w-100' /></label><br><a class='button is-primary mt-3' href={$url_liste}>Accéder à la soirée</a></div>";
        $this->titre = "Partager liste";
        return $div;
    }

    private function rechercherListe(){
        $url_token= $this->container->router->pathFor("rechercher");
        $html=<<<FIN
<form method="POST" action="$url_token">
    <label>Token de la liste:<br> <input type="text" name="token"/></label><br>
	<button type="submit">Rechercher</button>
</form>	
FIN;
        $this->titre = "Rechercher une liste";
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
            case(4):
                $content=$this->rechercherListe();
                break;
            case(5):
                $content=$this->partagerListe();
                break;
            default:
                $content='';

        }

        return VueMenu::get($this->container,$content,$this->titre);
    }
}