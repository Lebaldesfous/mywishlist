<?php
require 'vendor/autoload.php';

use \mywishlist\controls\MonControleur;
use \mywishlist\controls\ControleurListe;
use \mywishlist\controls\ControleurItem;

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
$app->get('/listes'    , MonControleur::class.':afficherListes')->setName('aff_listes');

$app->get("/liste/creer",ControleurListe::class.":formCreer")->setName("formListe");
$app->post("/liste/creer",ControleurListe::class.":creer")->setName("creerListe");


$app->get('/liste/{token}/modifier',ControleurListe::class.':formModifierListe')->setName('formModifierListe');
$app->post("/liste/{token}/modifier",ControleurListe::class.':modifierListe')->setName('modifierListe');


$app->get('/liste/{uuid}', ControleurListe::class.':getListe' )->setName('aff_liste' );

$app->get("/liste/{uuid}/creer",ControleurItem::class.":formCreerItem")->setName("formItem");
$app->post("/liste/{uuid}/creer",ControleurItem::class.":creerItem")->setName("creerItem");

$app->get("/liste/{uuid}/{id_item}/modifier",ControleurItem::class.":formModifierItem")->setName("formModifierItem");
$app->post("/liste/{uuid}/{id_item}/modifier",ControleurItem::class.":ModifierItem")->setName("modifierItem");

$app->get('/liste/{uuid}/item/{id_item}' , ControleurItem::class.':afficherItem'  )->setName('aff_item'  );

$app->delete('/liste/{uuid}/{id_item}/modifier',ControleurItem::class.':supprimerItem')->setName('supprimerItem');


$app->get('/nouvelitem',MonControleur::class.':formItem')->setName('formItem');
$app->post('/nouvelitem',MonControleur::class.':newItem')->setName('newItem');

$app->get('/formlogin',MonControleur::class.':formLogin')->setName('formLogin');
$app->post('/nouveaulogin',MonControleur::class.':nouveaulogin')->setName('nouveaulogin');

$app->get('/testform',MonControleur::class.':testform')->setName('testform');
$app->post('/testpass',MonControleur::class.':testpass')->setName('testpass');

$app->run();