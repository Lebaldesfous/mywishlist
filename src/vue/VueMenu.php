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

        $url_logo = 'https://www.carrefour.fr/media/540x540/Photosite/BAZAR/PAPETERIE/3037929416015_PHOTOSITE_20191115_050759_0.jpg?placeholder=1';

        $url_sign_up = "#";
        $url_sign_in = "#";

        return <<<END
        <!DOCTYPE html>
        <html>
            <head>
                <title>MyWishList - $title</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
                <link rel="icon" type="image/png" href="$url_logo" />
            </head>
            <body>
            <nav class="navbar is-primary" role="navigation" aria-label="main navigation">
                <div class="navbar-brand">
                    <a class="navbar-item" href="$url_accueil">
                        <img src="$url_logo">
                    </a>

                    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                    </a>
                </div>

                <div id="navbarBasicExample" class="navbar-menu">
                    <div class="navbar-start">
                    <!--
                    <a class="navbar-item">
                        Home
                    </a>

                    <a class="navbar-item">
                        Documentation
                    </a>
                    -->

                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                            Listes
                        </a>

                        <div class="navbar-dropdown">
                            <a class="navbar-item" href="$url_listes">
                                Listes
                            </a>
                            <a class="navbar-item" href="$url_form_liste">
                                Ajouter
                            </a>
                            <!--
                            <a class="navbar-item">
                                Contact
                            </a>
                            <hr class="navbar-divider">
                            <a class="navbar-item">
                                Report an issue
                            </a>
                            -->
                        </div>
                    </div>

                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                            Items
                        </a>

                        <div class="navbar-dropdown">
                            <a class="navbar-item" href="$url_form_item">
                                Ajouter
                            </a>
                        </div>
                    </div>
                    </div>

                    <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                        <a class="button is-info" href=$url_sign_up>
                            <strong>S'inscrire</strong>
                        </a>
                        <a class="button is-light" href=$url_sign_in>
                            Se connecter
                        </a>
                        </div>
                    </div>
                    </div>
                </div>
            </nav>
            <h1 class="has-text-centered is-size-4">$title</h1>
            $content
            </body>
        </html>
        END;
    }



}




?>