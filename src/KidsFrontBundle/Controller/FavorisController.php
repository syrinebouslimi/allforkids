<?php

namespace KidsFrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FavorisController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function getAllFavorisByUserAction()
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $idUser = $user->getId();

        $em = $this->getDoctrine()->getManager();
        $allFavoris = $em->getRepository('UserBundle:UserEtablissementFavoris')->findBy(array('user' => $idUser));
        return $this->render('@KidsFront/afficherallfavoris.html.twig', array('favoris' => $allFavoris));

    }

    public function supprimerfavorisparidAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $favoris = $this->getDoctrine()->getRepository('UserBundle:UserEtablissementFavoris')->find($id);
        $em->remove($favoris);

        $em->flush();
        return $this->redirectToRoute('getAllFavoris');
    }

}
