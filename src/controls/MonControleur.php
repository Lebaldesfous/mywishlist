<?php
namespace mywishlist\controls;

use mywishlist\models\User;
use mywishlist\vue\VueParticipant;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use \mywishlist\vue\VueWish;
use \mywishlist\models\Liste;
use \mywishlist\models\Item;

class MonControleur {
	private $app;
	
	public function __construct($app) {
		$this->app = $app;
	}
	public function accueil(Request $rq, Response $rs, $args) {
        $vue = new \mywishlist\vue\VueParticipant([],$this->app);
        $rs->getBody()->write($vue->render(0));
        return $rs;
	}

    public function formListe(Request $rq, Response $rs,$args){
        $vue = new \mywishlist\vue\VueParticipant([],$this->app);
        $rs->getBody()->write($vue->render(5));
        return $rs;
    }

    public function newListe(Request $rq, Response $rs, $args) : Response {
        // pour enregistrer 1 liste.....
        $post = $rq->getParsedBody() ;
        $titre       = filter_var($post['titre']       , FILTER_SANITIZE_STRING) ;
        $description = filter_var($post['description'] , FILTER_SANITIZE_STRING) ;
        $l = new Liste();
        $l->titre = $titre;
        $l->description = $description;
        $l->save();
        $url_listes = $this->app->router->pathFor( 'aff_listes' ) ;
        return $rs->withRedirect($url_listes);
    }

    public function formItem(Request $rq, Response $rs,$args){
        $vue = new \mywishlist\vue\VueParticipant([],$this->app);
        $rs->getBody()->write($vue->render(7));
        return $rs;
    }

    public function newItem(Request $rq, Response $rs, $args) : Response {
        // pour enregistrer 1 liste.....
        $post = $rq->getParsedBody() ;
        $nom       = filter_var($post['nom']       , FILTER_SANITIZE_STRING) ;
        $description = filter_var($post['description'] , FILTER_SANITIZE_STRING) ;
        $l_id       = filter_var($post['id_liste']       , FILTER_SANITIZE_STRING) ;
        $i = new Item();
        $i->nom = $nom;
        $i->descr = $description;
        $i->liste_id=$l_id;
        $i->save();
        $url_listes = $this->app->router->pathFor( 'racine' ) ;
        return $rs->withRedirect($url_listes);
    }

	public function afficherListes(Request $rq, Response $rs, $args) {
	    $listel=\mywishlist\models\Liste::all();
        $vue= new \mywishlist\vue\vueParticipant($listel->toArray(),$this->app);
		$rs->getBody()->write($vue->render(1)) ;
		return $rs;
	}


	public function afficherListe(Request $rq, Response $rs, $args) {
		$rs->getBody()->write('afficherListe no='.$args['no']) ;
		return $rs;
	}
	public function afficherItem(Request $rq, Response $rs, $args) {
	    $item =\mywishlist\models\Item::find($args);
	    $vue = new \mywishlist\vue\vueParticipant($item->toArray(),$this->app);
		$rs->getBody()->write($vue->render(3)) ;
		return $rs;
	}

    public function formlogin(Request $rq, Response $rs,$args){
        $vue = new \mywishlist\vue\VueParticipant([],$this->app);
        $rs->getBody()->write($vue->render(6));
        return $rs;
    }

    public function nouveaulogin(Request $rq, Response $rs,$args){
        $post = $rq->getParsedBody() ;
        $login       = filter_var($post['login']       , FILTER_SANITIZE_STRING) ;
        $pass = filter_var($post['pass'] , FILTER_SANITIZE_STRING) ;
        $u2=User::where('login','=',$login)->first();
        if($u2->id==0){
            $u =new User();
            $u->login=$login;
            $u->pass=password_hash($pass,PASSWORD_DEFAULT);
            $u->save();
        }else{
            $login='Existe déjà';
        }

        $vue = new VueParticipant(['login' => $login],$this->app);
        $rs->getBody()->write($vue->render(9));
        return $rs;
    }



    public function testform(Request $rq, Response $rs,$args){
        $vue = new \mywishlist\vue\VueParticipant([],$this->app);
        $rs->getBody()->write($vue->render(8));
        return $rs;
    }

    public function testpass(Request $rq, Response $rs,$args){
        $post = $rq->getParsedBody() ;
        $login       = filter_var($post['login']       , FILTER_SANITIZE_STRING) ;
        $pass = filter_var($post['pass'] , FILTER_SANITIZE_STRING) ;
        $u = User::where('login' ,'=',$login)->first();
        $res=password_verify($pass,$u->pass);
        $vue = new VueParticipant(['message'=>$res],$this->app);
        $rs->getBody()->write($vue->render(10));
        return $rs;
    }
}