<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 12/12/2017
 * Time: 15:29
 */

namespace Projet\YdaysManagerBundle\Controller;

use Projet\YdaysManagerBundle\Entity\Project;
use Projet\YdaysManagerBundle\ProjetYdaysManagerBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class YdaysManagerController extends Controller
{
    public function accueilAction(){
        return $this->render('ProjetYdaysManagerBundle:YdaysManager:accueil.html.twig');
    }

    public function loginAction(){
        return $this -> render('ProjetYdaysManagerBundle:YdaysManager:login.html.twig');
    }

    public function ficheProjetAction($id){
        $projet = new Projet();

        return $this->render("ProjetYdaysManagerBundle:YdaysManager:ficheProjet.html.twig", array('id' => $id));
    }

    public function proposerProjetAction(){
        return $this->render('ProjetYdaysManagerBundle:YdaysManager:proposerProjet.html.twig');
    }

    public function lesProjetsAction(){
        return $this->render('ProjetYdaysManagerBundle:YdaysManager:lesProjets.html.twig');
    }


}