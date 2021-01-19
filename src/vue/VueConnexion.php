<?php


namespace mywishlist\vue;

use mywishlist\vue\VueMenu;

class VueConnexion
{
    private $tab; // tab array PHP
    private $container;
    private $titre="";

    public function __construct($tab,$container) {
        $this->tab = $tab;
        $this->container=$container;

    }

    public function inscription(){
        $post = $this->container->router->pathFor('inscription');
        $html =<<<FIN
<form method="POST" action="$post">
	<label>Nom d'utilisateur:<br> <input type="text" name="username"/></label><br>
	<label>Mot de passe: <br><input type="password" name="password"/></label><br>
	<button type="submit">S'inscrire</button>
</form>	
FIN;
        $this->titre="Inscription";
        return $html;
    }

    public function connexion(){
        $post = $this->container->router->pathFor('connexion');
        $html =<<<FIN
        <form method="POST" action="$post">
            <label>Nom d'utilisateur:<br> <input type="text" name="username"/></label><br>
            <label>Mot de passe: <br><input type="password" name="password"/></label><br>
            <button type="submit">S'inscrire</button>
        </form>	
FIN;
        $this->titre="Connexion";
        return $html;
    }


    public function render($select){
        switch($select){
            case 1:
                $content = $this->inscription();
                break;
            case 2:
                $content=$this->connexion();
                break;
            default:
                $content ='';
        }

        return VueMenu::get($this->container,$content,$this->titre);
    }
}