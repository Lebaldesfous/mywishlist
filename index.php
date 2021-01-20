<?php
require 'vendor/autoload.php';

use \mywishlist\controls\MonControleur;
use \mywishlist\controls\ControleurListe;
use \mywishlist\controls\ControleurItem;
use \mywishlist\controls\ControleurConnexion;
use \mywishlist\controls\ControleurProfil;

$config = ['settings' => [
		'displayErrorDetails' => true
]];
$db =new \Illuminate\Database\Capsule\Manager();
$db->addConnection(parse_ini_file('src/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();
$container = new \Slim\Container($config);
$app = new \Slim\App($container);

$app->get('/'          , ControleurListe::class.':accueil'       )->setName('racine'    );
$app->get('/listes'    , ControleurListe::class.':getListesPublique')->setName('aff_listes');

$app->get("/liste/creer",ControleurListe::class.":formCreer")->setName("formListe");
$app->post("/liste/creer",ControleurListe::class.":creer")->setName("creerListe");

$app->get("/liste/{uuid}/partage", ControleurListe::class.":partage")->setName('partageListe');


#$app->get('/liste/{token}/modifier',ControleurListe::class.':formModifierListe')->setName('formModifierListe');
#$app->post("/liste/{token}/modifier",ControleurListe::class.':modifierListe')->setName('modifierListe');
$app->get('/liste/modifier',ControleurListe::class.':formModifierListe')->setName('formModifierListe');
$app->post("/liste/modifier",ControleurListe::class.':modifierListe')->setName('modifierListe');
$app->get('/liste/rechercher',ControleurListe::class.':formRechercher')->setName('formRechercher');
$app->post('/liste/rechercher',ControleurListe::class.':rechercher')->setName('rechercher');

$app->get('/liste/{uuid}', ControleurListe::class.':getListe' )->setName('aff_liste' );

$app->get("/liste/{uuid}/creer",ControleurItem::class.":formCreerItem")->setName("formItem");
$app->post("/liste/{uuid}/creer",ControleurItem::class.":creerItem")->setName("creerItem");
$app->post("/liste/{uuid}/supprimer",ControleurListe::class.":supprimerListe")->setName("supprimerListe");

$app->get("/liste/{uuid}/{id_item}/modifier",ControleurItem::class.":formModifierItem")->setName("formModifierItem");
$app->post("/liste/{uuid}/{id_item}/modifier",ControleurItem::class.":modifierItem")->setName("modifierItem");

$app->get('/liste',ControleurItem::class.':formTokenListe')->setName("formToken");
$app->post('/liste',ControleurItem::class.':tokenListe')->setName("TokenListe");


$app->get('/liste/{uuid}/item/{id_item}' , ControleurItem::class.':afficherItem'  )->setName('aff_item'  );

$app->post('/liste/{uuid}/{id_item}/supprimer',ControleurItem::class.':supprimerItem')->setName('supprimerItem');

$app->get('/inscription',ControleurConnexion::class.':pageInscription')->setName('pageInscription');
$app->get('/connexion',ControleurConnexion::class.':pageConnexion')->setName('pageConnexion');

$app->get('/profil',ControleurProfil::class.':afficherProfil')->setName('profil');

$app->post('/inscription',ControleurConnexion::class.':inscription')->setName('inscription');
$app->post('/connexion',ControleurConnexion::class.':connexion')->setName('connexion');
$app->post('/deconnect',ControleurConnexion::class.':deconnect')->setName('deconnect');

$app->post('/profile/changePassword',ControleurProfil::class.':changerMotDePasse')->setName('changePassword');



$app->get('/liste/{uuid}/{id_item}/reserver', ControleurItem::class.':formReserverItem')->setName('formReserverItem');
$app->post('/liste/{uuid}/{id_item}/reserver', ControleurItem::class.':reserverItem')->setName('reserverItem');

$app->run();