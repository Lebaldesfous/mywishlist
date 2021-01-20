<?php

namespace mywishlist\vue;

class VueMenu {

    private static function getConnectButtons($container) {

        $url_sign_up = $container->router->pathFor('inscription');
        $url_sign_in = $container->router->pathFor('connexion');
        $url_deconnect = $container->router->pathFor('deconnect');
        $html = <<<END
        <a class="button is-info" href=$url_sign_up>
            <strong>S'inscrire</strong>
        </a>
        <a class="button is-light" href=$url_sign_in>
            Se connecter
        </a>
END;

        if (isset($_SESSION['user'])) {
            $html = <<<END
            <form action=$url_deconnect method="POST">
                <a class="button is-info" onclick="this.parentNode.submit()">
                    <strong>Déconnexion</strong>
                </a>
            </form>
END;
        }

        return $html;
    }

    /**
     * Fonction qui génère un template HTML avec le menu. Il doit être utiliser dans chaque fonction render() de chaque vue.
     * @param container l'objet container de la vue
     * @param content le contenu que la vue a généré et qui doit être affiché
     * @param title Le titre de la page
     * @return string le contenu HTML de la page, avec le menu
     */
    public static function get($container, $content, $title): string {

        session_start();

        $connectButtons = VueMenu::getConnectButtons($container);

        $root    = $container->router->pathFor( 'racine'                 ) ;
        $url_listes     = $container->router->pathFor( 'aff_listes'             ) ;
        //$url_item_2     = $container->router->pathFor( 'aff_item' , ['id' => 2] ) ;
        $url_form_liste = $container->router->pathFor( 'formListe'              ) ;
        $url_form_item = $container->router->pathFor( 'formItem' ,["uuid"=>'e35b86c734f614e2']) ;
        $url_form_login = $container->router->pathFor('formLogin');
        $url_test_login= $container->router->pathFor('testform');

        $url_logo = 'https://www.carrefour.fr/media/540x540/Photosite/BAZAR/PAPETERIE/3037929416015_PHOTOSITE_20191115_050759_0.jpg?placeholder=1';

        $connectedMessage = "";
        if (isset($_SESSION['user'])) {
            $connectedMessage = "<p>Vous êtes connecté en tant que {$_SESSION['user']['login']}</p><br>";
        }

        return <<<END
        <!DOCTYPE html>
        <html>
            <head>
                <title>MyWishList - $title</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
                <link rel="stylesheet" href="{$root}style/index.css">
                <link rel="icon" type="image/png" href="$url_logo" />
                <script src="{$root}/modules/navbar-mobile.js"></script>
                <script src="{$root}/modules/setup.js"></script>
            </head>
            <body>
                <nav class="navbar is-primary" role="navigation" aria-label="main navigation">
                    <div class="navbar-brand">
                        <a class="navbar-item" href="$root">
                            <img src="$url_logo">
                        </a>

                        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbar">
                            <span aria-hidden="true"></span>
                            <span aria-hidden="true"></span>
                            <span aria-hidden="true"></span>
                        </a>
                    </div>

                    <div id="navbar" class="navbar-menu">
                        <div class="navbar-start">

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
                                    $connectButtons
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <h1 class="has-text-centered title mr-2 mt-3">$title</h1>
                <hr>
                <div class="notification is-white m-5 box">
                    $connectedMessage
                    $content
                </div>
            </body>
        </html>
END;
    }



}




?>