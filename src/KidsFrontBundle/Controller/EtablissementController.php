<?php

namespace KidsFrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\Etablissement;
use UserBundle\Form\EtablissementType;
use Symfony\Component\Config\Definition\Exception\Exception;



class EtablissementController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('UserBundle:User')->findAll();
        return $this->render('KidsFrontBundle::Template_User.html.twig', array('u' => $users));
    }


    public function afficherEtabByIdAction($id)
    {
        $creche = $this->getDoctrine()->getRepository('UserBundle:Etablissement')->find($id);

        return $this->render('@KidsFront/detailsetablissement.html.twig', array('detail' => $creche));
    }


    public function espacePrestataireAction()
    {
        return $this->render('@KidsFront/espaceprestataire.html.twig');

    }


    public function ajouterEtablissementAction(Request $request)
    {
        $etablissement = new Etablissement();
        $form = $this->createForm(EtablissementType::class, $etablissement);
        $formview = $form->createView();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $id = $user->getId();

            $affectedUser = $this->getDoctrine()->getRepository('UserBundle:User')->findOneBy(array('id' => $id));
            $etablissement->setIdUserEtablissement($affectedUser);


            // uploaad image

            $imagefile = $etablissement->getImageEtablissement();

            $fileName = md5(uniqid()) . '.' . $imagefile->guessExtension();

            $imagefile->move(
                $this->getParameter('images_directory'),
                $fileName
            );


            $etablissement->setImageEtablissement($fileName);


//            var_dump($etablissement);
//            die($etablissement);
//

            $save = $this->getDoctrine()->getManager();

            $save->persist($etablissement);
            $save->flush();
            return $this->redirectToRoute('afficherConfimationApresCreationEtab');

        }

        return $this->render('@KidsFront/ajouteretablissement.html.twig', array('form' => $formview));
    }


    public function afficherConfimationApresCreationEtabAction()
    {


        return $this->render('@KidsFront/after_create_etablissement.html.twig');
    }





    public function modifieretablissementAction(Request $request)
    {

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();


        $etablissement = $this->getDoctrine()->getRepository('UserBundle:Etablissement')->findOneBy(array('idUserEtablissement'=>$id));
        $imageOld =$etablissement->getImageEtablissement();

        $form = $this->createForm(EtablissementType::class, $etablissement);
        $formView = $form->createView();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $imagefile = $etablissement->getImageEtablissement();

            if(is_null($imagefile))
            {
                $etablissement->setImageEtablissement($imageOld);
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                return $this->redirectToRoute('espace_prestataire');
            }else
                if(!is_null($imagefile))
                {
                    $fileName = md5(uniqid()) . '.' . $imagefile->guessExtension();

                    $imagefile->move(
                        $this->getParameter('images_directory'),
                        $fileName
                    );


                    $etablissement->setImageEtablissement($fileName);

                    $em = $this->getDoctrine()->getManager();
                    $em->flush();
                    return $this->redirectToRoute('espace_prestataire');
                }
        }
        return $this->render('@KidsFront/ajouteretablissement.html.twig', array('form' => $formView));
    }



    public function afficherEtabPrestataireInfoAction()
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();


        $etablissement = $this->getDoctrine()->getRepository('UserBundle:Etablissement')->findOneBy(array('idUserEtablissement'=>$id));

        return $this->render('@KidsFront/etablissementinfo.html.twig',array('detail'=>$etablissement));

    }


    public function supprimeretablissementparidAction($id)
    {
        try{
            $em=$this->getDoctrine()->getManager();
            $etablissement = $this->getDoctrine()->getRepository('UserBundle:Etablissement')->find($id);
            $em->remove($etablissement);

            $em->flush();
//            $this->get('session')->getFlashBag()->add(
//                'notice',
//                'Encadreur supprimé avec succés');
//            // return $this->forward('/affichevoiture',array('voiturerepo'=>$voiturerepo));
           return $this->redirectToRoute('espace_parent');
        }
        catch (Exception $e){
            $this->get('session')->getFlashBag()->add(
                'notic  e',
                'probléme lors de la suppression');
        }

    }


}
