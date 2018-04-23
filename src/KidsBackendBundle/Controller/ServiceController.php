<?php

namespace KidsBackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Service;
use UserBundle\Entity\TypeService;
use UserBundle\Form\ServiceType;


class ServiceController extends Controller
{

 //creation
    public function ajoutAction(Request $request)
    {
        //var_dump('call');die;

        $sv = new Service();
        $form=$this->createForm(ServiceType::class,$sv);
        $formView=$form->createView();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())

        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($sv);

            // $file stores the uploaded PDF file

            $file = $sv->getImagServ();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('images_directory'),
                $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $sv->setImagServ($fileName);






            $em->flush();
            return $this->redirect($this->generateUrl('afficherServiceBack'));
        }

        return $this->render('@KidsBackend/ajouterService.html.twig',array('form'=>$formView));
    }

//Affichage

    public function afficherServiceBackAction (Request $request)

    {

        $Uv=$this->getDoctrine()->getRepository('UserBundle:Service')->findAll();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator  = $this->get('knp_paginator');
        $result=$paginator->paginate(
            $Uv,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit',4)
        );






        return $this->render ( '@KidsBackend/afficherService.html.twig',array('serv'=>$result));

    }

//modification
    public function updateServiceAction(Request $request,$id)
    {

        $servi= $this->getDoctrine()->getRepository('UserBundle:Service')->find($id);
        $form=$this->createForm(ServiceType::class, $servi);
        $formview=$form->createView();
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($servi);

            //update image

            $file = $servi->getImagServ();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('images_directory'),
                $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $servi->setImagServ($fileName);


            // update image



            $em->flush();
            return $this->redirect($this->generateUrl('afficherServiceBack'));
        }
        return $this->render('@KidsBackend/ajouterService.html.twig',array('form'=>$formview));

    }

//supprimer
    public function suppServAction($id)
    {   $em=$this->getDoctrine()->getManager();
        $Pro=$this->getDoctrine()->getRepository('UserBundle:Service')->find($id);
        $em->remove($Pro);
        $em->flush();
        return $this->redirect($this->generateUrl('afficherServiceBack', array('form'=>$Pro)));
        //return $this->forward('@KidsBackendBundle:Service:afficherService',array('form'=>$Pro));
    }


///Recherche
    public function recherchebackAction(Request $request)
    {

        $search = $request->query->get('search');
        $publication= $this->getDoctrine()->getRepository('UserBundle:Service')->findBy(array('nomService'=>$search));


        $paginator  = $this->get('knp_paginator');
        $result=$paginator->paginate(
        // $query,
            $publication,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit',4)
        );

        if (strlen($search)!=0){

            return $this->render('@KidsBackend/afficherService.html.twig',array('serv'=>$result));

        } else {
//            return  $this->redirectToRoute('KidsBackendBundle:Service:afficherServiceBack');

            return $this->redirect($this->generateUrl('afficherServiceBack'));

        }
    }

}
