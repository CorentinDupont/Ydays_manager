<?php

namespace Projet\YdaysManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProjetYdaysManagerBundle:Default:index.html.twig');
    }
}
