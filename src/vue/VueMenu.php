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
        //$url_item_2     = $container->router->pathFor( 'aff_item' , ['id' => 2] ) ;
        $url_form_liste = $container->router->pathFor( 'formListe'              ) ;
        $url_form_item = $container->router->pathFor( 'formItem' ,["uuid"=>'e35b86c734f614e2']) ;
        $url_form_login = $container->router->pathFor('formLogin');
        $url_test_login= $container->router->pathFor('testform');

        return <<<END
        <!DOCTYPE html>
        <html>
            <head>
                <title>MyWishList - $title</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
            </head>
            <body>
            <nav class="navbar" role="navigation" aria-label="main navigation">
                <div class="navbar-brand">
                    <a class="navbar-item" href="$url_accueil">
                    <img src="https://www.carrefour.fr/media/540x540/Photosite/BAZAR/PAPETERIE/3037929416015_PHOTOSITE_20191115_050759_0.jpg?placeholder=1" width="112" height="28">
                    </a>

                    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    </a>
                </div>

                <div id="navbarBasicExample" class="navbar-menu">
                    <div class="navbar-start">
                    <a class="navbar-item">
                        Home
                    </a>

                    <a class="navbar-item">
                        Documentation
                    </a>

                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                        More
                        </a>

                        <div class="navbar-dropdown">
                        <a class="navbar-item">
                            About
                        </a>
                        <a class="navbar-item">
                            Jobs
                        </a>
                        <a class="navbar-item">
                            Contact
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item">
                            Report an issue
                        </a>
                        </div>
                    </div>
                    </div>

                    <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                        <a class="button is-primary">
                            <strong>Sign up</strong>
                        </a>
                        <a class="button is-light">
                            Log in
                        </a>
                        </div>
                    </div>
                    </div>
                </div>
                </nav>
                <h1><a href="$url_accueil">MyWishList</a></h1>
                <nav>
                    <ul>
                        <li><a href="$url_accueil">Accueil</a></li>
                        <li><a href="$url_listes">Listes</a></li>
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