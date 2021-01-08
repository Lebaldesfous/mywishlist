<?php
require 'vendor/autoload.php';

use \mywishlist\controls\MonControleur;
use \mywishlist\controls\ControleurListe;

$config = ['settings' => [
		'displayErrorDetails' => true
]];
$db =new \Illuminate\Database\Capsule\Manager();
$db->addConnection(parse_ini_file('src/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();
$container = new \Slim\Container($config);
$app = new \Slim\App($container);

$app->get('/'          , MonControleur::class.':accueil'       )->setName('racine'    );
$app->get('/listes'    , MonControleur::class.':afficherListes')->setName('aff_listes');
$app->get('/liste/{id}', ControleurListe::class.':getListe' )->setName('aff_liste' );
$app->get('/item/{id}' , MonControleur::class.':afficherItem'  )->setName('aff_item'  );

$app->get('/nouvelleliste',MonControleur::class.':formListe')->setName('formListe');
$app->post('/nouvelleliste',MonControleur::class.':newListe')->setName('newListe');
$app->get('/nouvelitem',MonControleur::class.':formItem')->setName('formItem');
$app->post('/nouvelitem',MonControleur::class.':newItem')->setName('newItem');

$app->get('/formlogin',MonControleur::class.':formLogin')->setName('formLogin');
$app->post('/nouveaulogin',MonControleur::class.':nouveaulogin')->setName('nouveaulogin');

$app->get('/testform',MonControleur::class.':testform')->setName('testform');
$app->post('/testpass',MonControleur::class.':testpass')->setName('testpass');

$app->run();