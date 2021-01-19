<?php

namespace mywishlist\vue;

class VueProfil {

    private $tab;
    private $container;
    private $titre="";

    public function __construct($tab,$container) {
        $this->tab = $tab;
        $this->container=$container;
    }

    public function afficherProfil(){
        $changePass= $this->container->router->pathFor('changePassword');
        $html =<<<FIN
<form method="POST" action="$changePass">
	<label>Ancien mot de passe:<br> <input type="password" name="old"/></label><br>
	<label>Nouveau mot de passe:<br> <input type="password" name="new"/></label><br>
	<button type="submit">Confirmer</button>
</form>	
FIN;
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->titre="Profil de {$_SESSION['user']['login']}";
        return $html;
    }


    public function render($select){
        switch($select){
            case 0:
                $content = $this->afficherProfil();
                break;
            default:
                $content ='';
        }

        return VueMenu::get($this->container,$content,$this->titre);
    }
}