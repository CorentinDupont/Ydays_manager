<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 09/01/2018
 * Time: 22:06
 */

namespace Projet\YdaysManagerBundle\Controller;


use Projet\YdaysManagerBundle\Entity\Desire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Desire Controller
 */
class DesireController extends Controller
{

    /**
     * Afficher toutes les demandes à l'administrateur
     */
    public function adminDemandeAction(){
        $em = $this->getDoctrine()->getManager();
        $desireRepository = $em->getRepository(Desire::class);
        $allDesires = $desireRepository->findAll();

        return $this->render('ProjetYdaysManagerBundle:YdaysManager:AdminDemande.html.twig', array('desires'=>$allDesires));
    }

}