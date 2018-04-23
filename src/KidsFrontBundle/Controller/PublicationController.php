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
        $publication = $this->getDoctrine()->getRepository('UserBundle:Publication')->findAll();

        return $this->render('KidsFrontBundle::Publications.html.twig', array('publication' => $publication));
    }

    public function afficherpublicationdetailsAction($id)
    {
        $publication = $this->getDoctrine()->getRepository('UserBundle:Publication')->find($id);
        return $this->render('KidsFrontBundle::PublicationDetails.html.twig', array('publication'=>$publication));
    }

//    public function afficherpublicationtypeAction($typePublication)
//    {
//        $publication= $this->getDoctrine()->getRepository('UserBundle:Publication')->findBy(array('typePublication'=>$typePublication));
//        return $this->render('KidsFrontBundle::Publications.html.twig', array('publication'=>$publication));
//    }

    public function afficherpublicationcategorieAction($categoriePublication)
    {
        $publication= $this->getDoctrine()->getRepository('UserBundle:Publication')->findBy(array('categoriePublication'=>$categoriePublication));
        return $this->render('KidsFrontBundle::PublicationsSearch.html.twig', array('publication'=>$publication));
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
}
