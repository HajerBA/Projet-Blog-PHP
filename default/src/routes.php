<?php

use Slim\Http\Request;
use Slim\Http\Response;
use simplon\entities\Article;
use simplon\dao\DaoArticle;
use simplon\dao\DaoPerson;
use simplon\entities\Person;



// Routes
$app->get('/', function (Request $request, Response $response, array $args) {
      
    // Render index view
    return $this->view->render($response, 'index.twig');
})->setName('index');

$app->get('/article/', function (Request $request, Response $response, array $args) {
    $dao = new DaoPerson();
    $persons=$dao->getAll();
    $nbart = [];
    for($i = 0; $i < count($persons); ++$i) {
        $personId = $persons[$i]->getId();
        $nbart[$personId]=$dao->getNbarticle($personId);
        
    }
    
    // Render index view
    return $this->view->render($response, 'article.twig', [
        
        'persons' => $persons,
        'nbarticle' => $nbart
    ]);
})->setName('article');

$app->get('/myblog', function (Request $request, Response $response, array $args) {
    $person=$_SESSION['person'];
    $dao = new DaoPerson();
   // $person=$dao->getById($args['id']);
    $daoArt=new DaoArticle();
    $themes=$daoArt->getThemeByID($person->getId());

    //var_dump($themes);
    return $this->view->render($response, 'myblog.twig', [
         'person' => $person,
        'themes' =>$themes
    ]);

   
})->setName('myblog');

$app->get('/personArtSV/{id}', function (Request $request, Response $response, array $args) {
  
    $dao = new DaoPerson();
    $person=$dao->getById($args['id']);
    $daoArt=new DaoArticle();
    $themes=$daoArt->getThemeByID($args['id']);

    
    return $this->view->render($response, 'personArtSV.twig', [
        'person' => $person,
       'themes' =>$themes
   ]);
   
})->setName('personArtSV');


//pour afficher liste article
 $app->get('/addart', function (Request $request, Response $response, array $args) {
    $dao = new DaoPerson();
    $daoArt=new DaoArticle();
    $person=$_SESSION['person'];

    $articles= $daoArt->getByUserId($person->getId());
    
    // Render index view
    return $this->view->render($response, 'addart.twig', [
       'person'=>$person,
       'articles'=> $articles
        
    ]);
 })->setName('addart');

$app->get('/connexion', function (Request $request, Response $response, array $args) {
    
    if(!empty($_SESSION['person'])){

     $addArticleurl=$this->router->pathFor('myblog');
     return $response->withRedirect($addArticleurl);
    } else {
        
        return $this->view->render($response, 'connexion.twig');
    }
    
    
})->setName('connexion');



$app->post('/connexion', function (Request $request, Response $response, array $args) {
    $dao = new DaoPerson();
    $daoArt = new DaoArticle();
    $tabperson=$request->getParsedBody();
    //$person=$dao->getById($args['id']);
    $person=$dao->getMail($tabperson['mail']);
    $addArticleurl=$this->router->pathFor('myblog');
    $cnxUrl=$this->router->pathFor('connexion');
    
       
        if ( $person->getPassword() === $tabperson['pwd']) {
           
            $_SESSION['person']=$person;
            $_SESSION['themes']=$daoArt->getById($person->getId());
            return $response->withRedirect( $addArticleurl);
        } else {
            return $response->withRedirect($cnxUrl);
        }
                 
})->setName('connexion');

$app->get('/inscription', function (Request $request, Response $response, array $args) {
   

    // Render index view
    return $this->view->render($response, 'inscription.twig', [
        'args' => $args
    ]);
})->setName('inscription');

//pour ajouter article

$app->post('/addart', function (Request $request, Response $response, array $args) {
    $daoArt = new DaoArticle();
    $dao = new DaoPerson();
    $person=$_SESSION['person'];
      
    $tabArt=$request->getParsedBody();
    $newArt = new Article($tabArt['theme'],$tabArt['contenu']);
    $daoArt->add($newArt,$person->getId());

    // rediriger vers GET addart
    $route = $this->router->pathFor('addart');
    return $response->withRedirect($route); 
})->setName('addart');

$app->post('/inscription/', function (Request $request, Response $response, array $args) {
    $dao = new DaoPerson;
    $tabperson=$request->getParsedBody();
    $newp = new Person($tabperson['name'],$tabperson['surname'],$tabperson['mail'],$tabperson['pwd'],$tabperson['gender']);
    $dao->add($newp);
    $dao->getAll();
     return $response->withRedirect('/connexion');
})->setName('inscription');

$app->get('/deleteArt/{id}', function (Request $request, Response $response, array $args) {
   
    $daoArt = new DaoArticle();
    $dao = new DaoPerson();
   // $person=$_SESSION['person'];
   
    $daoArt->delete(intval($args['id']));
   // $param = ['id' => $args['id']];

    return $response->withRedirect($this->router->pathFor('myblog'));
})->setName('deleteArt');

$app->get('/updateArt/{id}', function (Request $request, Response $response, array $args) {
    $person=$_SESSION['person'];
    $daoArt = new DaoArticle();
    
    $articles = $daoArt->getById($args['id']);
    return $this->view->render($response, 'updateArt.twig', [
        'article' => $articles
    ]);
})->setName('updateArt');

$app->post('/updateArt/{id}', function (Request $request, Response $response, array $args) {
    $daoArt = new DaoArticle();
    $person=$_SESSION['person'];
      
    $tabArt=$request->getParsedBody();
    // $newArt = new Article($tabArt['theme'],$tabArt['contenu']);
    
    $articles= $daoArt->getById($args['id']);
    $articles->setTheme($tabArt['theme']);
    $articles->setTheme($tabArt['contenu']);
    
    
    $daoArt->update($articles);
    return $response->withRedirect($this->router->pathFor('addart', [
        'id' => $tabArt['id']
    ]));
})->setName('updateArt');

$app->get('/signOut', function (Request $request, Response $response, array $args) {
   
    session_destroy();

    return $response->withRedirect($this->router->pathFor('index'));
})->setName('signOut');



   
   