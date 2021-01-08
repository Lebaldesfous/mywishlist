<?php


namespace mywishlist\vue;


class VueListe
{
    private $tab; // tab array PHP
    private $container;

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
        $url_accueil    = $this->container->router->pathFor( 'racine'                 ) ;

        $html = <<<FIN
<!DOCTYPE html>
<html>
  <head>
    <title>Exemple</title>
  </head>
  <body>
		<h1><a href="$url_accueil">Wish List</a></h1>
    $content
  </body>
</html>
FIN;;
        return $html;
    }
}