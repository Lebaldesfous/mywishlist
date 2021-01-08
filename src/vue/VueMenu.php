<?php

namespace mywishlist\vue;

class VueMenu {

    /**
     * Fonction qui génère un template HTML avec le menu. Il doit être utiliser dans chaque fonction render() de chaque vue.
     * @param container l'objet container de la vue
     * @param content le contenu que la vue a généré et qui doit être affiché
     * @param title Le titre de la page
     * @return string le contenu HTML de la page, avec le menu
     */
    public static function get($container, $content, $title): string {

        $url_accueil    = $container->router->pathFor( 'racine'                 ) ;
        $url_listes     = $container->router->pathFor( 'aff_listes'             ) ;
        $url_item_2     = $container->router->pathFor( 'aff_item' , ['id' => 2] ) ;
        $url_form_liste = $container->router->pathFor( 'formListe'              ) ;
        $url_form_item = $container->router->pathFor( 'formItem'              ) ;
        $url_form_login = $container->router->pathFor('formLogin');
        $url_test_login= $container->router->pathFor('testform');

        return <<<END
        <!DOCTYPE html>
        <html>
            <head>
                <title>MyWishList - $title</title>
            </head>
            <body>
                <h1><a href="$url_accueil">MyWishList</a></h1>
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
        END;
    }



}




?>