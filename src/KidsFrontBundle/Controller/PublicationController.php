<?php

namespace KidsFrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\CategoriePublication;
use UserBundle\Entity\Publication;
use UserBundle\Entity\TypePublication;
use UserBundle\Form\CategoriePublicationType;
use UserBundle\Form\PublicationType;
use UserBundle\Form\TypePublicationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;


class PublicationController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function afficherpublicationAction()
    {

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $idUser = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $allFavoris = $em->getRepository('UserBundle:UserEtablissementFavoris')->findBy(array('user' => $idUser));

        $publication = $this->getDoctrine()->getRepository('UserBundle:Publication')->findAll();

        return $this->render('KidsFrontBundle::Publications.html.twig', array('publication' => $publication,'favoris'=>$allFavoris));
    }

    public function afficherpublicationdetailsAction($id)
    {

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $idUser = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $allFavoris = $em->getRepository('UserBundle:UserEtablissementFavoris')->findBy(array('user' => $idUser));

        $publication = $this->getDoctrine()->getRepository('UserBundle:Publication')->find($id);
        return $this->render('KidsFrontBundle::PublicationDetails.html.twig', array('publication'=>$publication,'favoris'=>$allFavoris));
    }

//    public function afficherpublicationtypeAction($typePublication)
//    {
//        $publication= $this->getDoctrine()->getRepository('UserBundle:Publication')->findBy(array('typePublication'=>$typePublication));
//        return $this->render('KidsFrontBundle::Publications.html.twig', array('publication'=>$publication));
//    }

    public function afficherpublicationcategorieAction($categoriePublication)
    {

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $idUser = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $allFavoris = $em->getRepository('UserBundle:UserEtablissementFavoris')->findBy(array('user' => $idUser));

        $publication= $this->getDoctrine()->getRepository('UserBundle:Publication')->findBy(array('categoriePublication'=>$categoriePublication));
        return $this->render('KidsFrontBundle::PublicationsSearch.html.twig', array('publication'=>$publication,'favoris'=>$allFavoris));
    }

    public function imprimerpublicationAction(Request $request, $id)
    {
        $snappy = $this->get('knp_snappy.pdf');
        $snappy->setOption('no-outline', true);
        $snappy->setOption('page-size', 'LETTER');
        $snappy->setOption('encoding', 'UTF-8');
        $publication = $this->getDoctrine()->getRepository('UserBundle:Publication')->find($id);
        $html = $this->renderView('KidsFrontBundle::ImprimerPublication.html.twig', array(
            'publication' => $publication,
            'Title' => 'Publication'
        ));

        $filename = 'myFirstSnappyPDF';

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $filename . '.pdf"'
            )
        );
    }

    public function proposerpublicationAction(Request $request)
    {

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $idUser = $user->getId();

        $em = $this->getDoctrine()->getManager();
        $allFavoris = $em->getRepository('UserBundle:UserEtablissementFavoris')->findBy(array('user' => $idUser));


        $publication = new Publication();
        $form = $this->createForm(PublicationType::class, $publication);
        $formView = $form->createView();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imagefile = $publication->getImagePublication();
            $videofile = $publication->getContenuPublication();

            $fileName = md5(uniqid()) . '.' . $imagefile->guessExtension();
            $fileName1 = md5(uniqid()) . '.' . $videofile->guessExtension();

            $imagefile->move(
                $this->getParameter('images_directory'),
                $fileName
            );

            $videofile->move(
                $this->getParameter('videos_directory'),
                $fileName1
            );
            $publication->setImagePublication($fileName);
            $publication->setContenuPublication($fileName1);

            $publication->setEtatPublication("Non Publié");

//            $user = $this->getUser();
//            $iduser = $user->getId();
//            $publication->setIdUserPublication($user);
//            $dateC = date('H:i:s \0\n d/m/Y');
//            $publication->setDatePublication($dateC);
            $em = $this->getDoctrine()->getManager();
            $em->persist($publication);
            $em->flush();
            return $this->forward('KidsFrontBundle:Publication:afficherpublication');
        }
        return $this->render('KidsFrontBundle::ProposerPublication.html.twig', array('form' => $formView,'favoris' => $allFavoris));
    }
}
