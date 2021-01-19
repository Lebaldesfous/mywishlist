<?php
namespace mywishlist\vue;

class VueParticipant {

    private $tab; // tab array PHP
    private $container;

    public function __construct($tab,$container) {
        $this->tab = $tab;
        $this->container=$container;
    }

    private function lesListes() {
        $html = '';
        foreach($this->tab as $liste){
            $html .= "<li>{$liste['titre']}, {$liste['description']}</li>";
        }
        $html = "<ul>$html</ul>";
        return $html;
    }



    private function unItem(){
        $i = $this->tab[0];
        $html = "<h2>Item {$i['id']}</h2>";
        $html .= "<b>Nom:</b> {$i['nom']}<br>";
        $html .= "<b>Descr:</b> {$i['descr']}<br>";
        $html .= "<b>Image:</b>{$i['url_image']}<br>";
        return $html;
    }
    private function formListe(){
        $url_new_liste= $this->container->router->pathFor('newListe');
        $html =<<<FIN
<form method="POST" action="$url_new_liste">
	<label>Titre:<br> <input type="text" name="titre"/></label><br>
	<label>Description: <br><input type="text" name="description"/></label><br>
	<button type="submit">Enregistrer la liste</button>
</form>	
FIN;
        return $html;
    }

    private function formlogin(){
        $url_new_login= $this->container->router->pathFor('nouveaulogin');
        $html =<<<FIN
<form method="POST" action="$url_new_login">
	<label>Login:<br> <input type="text" name="login"/></label><br>
	<label>Mot de passe: <br><input type="text" name="pass"/></label><br>
	<button type="submit">Enregistrer le login</button>
</form>	
FIN;
        return $html;
    }

    private function testform(){
        $url_test_pass= $this->container->router->pathFor('testpass');
        $html =<<<FIN
<form method="POST" action="$url_test_pass">
	<label>Login:<br> <input type="text" name="login"/></label><br>
	<label>Mot de passe: <br><input type="text" name="pass"/></label><br>
	<button type="submit">Tester le login</button>
</form>	
FIN;
        return $html;
    }

    private function formItem(){
        $url_new_liste= $this->container->router->pathFor('newItem');
        $html =<<<FIN
<form method="POST" action="$url_new_liste">
	<label>Nom:<br> <input type="text" name="nom"/></label><br>
	<label>Description: <br><input type="text" name="description"/></label><br>
	<label>Id Liste: <br><input type="text" name="id_liste"/></label><br>
	<label>Url image:<br><input type="text" name="url_image"/></label><br>
	<button type="submit">Enregistrer l'item</button>
</form>	
FIN;
        return $html;
    }



    public function render( $select ) {

        switch ($select) {
            case 1 :
                $content = $this->lesListes();
                break;
            case 3 :
                $content = $this->unItem();
                break;
            case 5:
                $content=$this->formListe();
                break;
            case 7:
                $content=$this->formItem();
                break;
            case 6:
                $content=$this->formlogin();
                break;
            case 8:
                $content=$this->testform();
                break;
            case 9:
                $content = 'Login <b>'.$this->tab['login'].'</b> enregistre';
                break;
            case 10:
                $res=($this->tab['message'])?'OK':'KO';
                $content = 'Mot de passe <b>'.$res;
                break;
            default:
                $content='';

        }
        $url_accueil    = $this->container->router->pathFor( 'racine'                 ) ;
        $url_listes     = $this->container->router->pathFor( 'aff_listes'             ) ;
        $url_item_2     = $this->container->router->pathFor( 'aff_item' , ['id' => 2] ) ;
        $url_form_liste = $this->container->router->pathFor( 'formListe'              ) ;
        $url_form_item = $this->container->router->pathFor( 'formItem'              ) ;
        $url_form_login = $this->container->router->pathFor('formLogin');
        $url_test_login= $this->container->router->pathFor('testform');
        $html = <<<FIN
<!DOCTYPE html>
<html>
  <head>
    <title>Exemple</title>
  </head>
  <body>
		<h1><a href="$url_accueil">Wish List</a></h1>
		<nav>
			<ul>
				<li><a href="$url_accueil">Accueil</a></li>
				<li><a href="$url_listes">Listes</a></li>
				<li><a href="$url_item_2">Item 2</a></li>
				<li><a href="$url_form_liste">Nouvelle Liste</a></li>
				<li><a href="$url_form_item">Nouvel Item</a></li>
				<li><a href="$url_form_login">Nouveau Login</a></li>
				<li><a href="$url_test_login">Test Login</a></li>
			</ul>
		</nav>
    $content
  </body>
</html>
FIN;

        return $html;
    }

}