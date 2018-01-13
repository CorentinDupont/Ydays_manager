<?php

namespace Projet\YdaysManagerBundle\Controller;

use Projet\YdaysManagerBundle\Entity\Entreprise;
use Projet\YdaysManagerBundle\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Entreprise controller.
 *
 * @Route("entreprise")
 */
class EntrepriseController extends Controller
{
    /**
     * Lists all entreprise entities.
     *
     * @Route("/", name="listEntreprises")
     * @Method("GET")
     */
    public function listEntreprisesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entreprises = $em->getRepository('ProjetYdaysManagerBundle:Entreprise')->findAll();

        return $this->render('ProjetYdaysManagerBundle:YdaysManager:listEntreprises.html.twig', array(
            'entreprises' => $entreprises,
        ));
    }

    /**
    * Push New Entreprise in DataBase
    *
    * @Route("/pushEntrepriseInDb", options={"expose"=true}, name="projet_ydays_manager_push_entreprise_in_db")
    * @Method("POST")
    * @return Response
    * @return JsonResponse_
    */
    public function pushEntrepriseInDbAction(Request $request){
        if($request->isXmlHttpRequest()){
           
            //Création d'une entreprise
            $newEntreprise = new Entreprise();
            $newEntreprise -> setNomEntreprise($request->get('nameEts'));
            $newEntreprise -> setInfoEntreprise($request->get('infosEts'));
            $newEntreprise -> setSiretEntreprise($request->get('siretEts'));
            $newEntreprise -> setAdresseEntreprise($request->get('addressEts'));
            $newEntreprise -> setCpEntreprise($request->get('cpEts'));
            $newEntreprise -> setVilleEntreprise($request->get('cityEts'));
            $newEntreprise -> setImgEntreprise($request->get('imgEts'));

            $tab[]=$newEntreprise->getNomEntreprise();
            $tab[]=$newEntreprise->getAdresseEntreprise();
            $tab[]=$newEntreprise->getCpEntreprise();
            $tab[]=$newEntreprise->getSiretEntreprise();
            $tab[]=$newEntreprise->getImgEntreprise();
            $tab[]=$newEntreprise->getVilleEntreprise();
            $tab[]=$newEntreprise->getInfoEntreprise();

            
            $em = $this -> getDoctrine() -> getManager();

            //On dit au manager de prendre en compte nos nouvelles entités
            $em -> persist($newEntreprise);

            //On valide l'insertion en base de donnée.
            $em -> flush();

            return new JsonResponse(array('data' => 'ok'));
        }
        return new Response(
            "Erreur"
        );
    }

    /**
    * Suppression entreprise
    *
    * @Route("/ListEntreprises/deleteEntreprise", options={"expose"=true}, name="projet_ydays_manager_entreprise_delete")
    * @Method("POST")
    * @return Response
    * @return JsonResponse
    */
    public function deleteEntrepriseAction(Request $request){
        if($request->isXmlHttpRequest()){

            $em = $this -> getDoctrine()->getManager();

            $entrepriseToDelete = $em->getRepository(Entreprise::class)->find($request->get('deletedEntrepriseId'));

            $em->remove($entrepriseToDelete);
            $em->flush();

            return new JsonResponse(array('data' => 'ok'));
        }

        return new Response(
            'Erreur : Page appelée avec une autre méthode que ajax.'
        );
    }

    /**
     * Creates a new entreprise entity.
     *
     * @Route("/new", name="entreprise_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $entreprise = new Project();
        $form = $this->createForm('Projet\YdaysManagerBundle\Form\EntrepriseType', $entreprise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entreprise);
            $em->flush();

            return $this->redirectToRoute('listEntreprises', array('id' => $entreprise->getId()));
        }

        return $this->render('entreprise/new.html.twig', array(
            'entreprise' => $entreprise,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a entreprise entity.
     *
     * @Route("/{id}", name="entreprise_show")
     * @Method("GET")
     */
    public function showAction(Entreprise $entreprise)
    {
        $deleteForm = $this->createDeleteForm($entreprise);

        return $this->render('entreprise/show.html.twig', array(
            'entreprise' => $entreprise,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing entreprise entity.
     *
     * @Route("/{id}/edit", name="entreprise_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Entreprise $entreprise)
    {
        $deleteForm = $this->createDeleteForm($entreprise);
        $editForm = $this->createForm('Projet\YdaysManagerBundle\Form\EntrepriseType', $entreprise);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('entreprise_edit', array('id' => $entreprise->getId()));
        }

        return $this->render('entreprise/edit.html.twig', array(
            'entreprise' => $entreprise,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a entreprise entity.
     *
     * @Route("/{id}", name="entreprise_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Entreprise $entreprise)
    {
        $form = $this->createDeleteForm($entreprise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entreprise);
            $em->flush();
        }

        return $this->redirectToRoute('ListEntreprises');
    }

    /**
     * Creates a form to delete a entreprise entity.
     *
     * @param Entreprise $entreprise The entreprise entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Entreprise $entreprise)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('entreprise_delete', array('id' => $entreprise->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
