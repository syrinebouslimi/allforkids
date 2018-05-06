<?php

namespace KidsFrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Request;

class ProduitfrontController extends Controller
{
    public function ProduitAfficherFrontAction()
    {
        $Uv = $this->getDoctrine()->getRepository('UserBundle:Produit')->findAll();
        return $this->render('@KidsFront/ProduitAfficherFront.html.twig', array('form' => $Uv));
    }

//public function ProduitDescriptionAficherFrontAction()
//{
//    $Uv = $this->getDoctrine()->getRepository('UserBundle:Produit')->findAll();
//    return $this->render('@KidsFront/ProduitDescriptionAficherFront.html.twig', array('serv' => $Uv));
//}
    public function detailProduitFrontAction ($id)

    {
        $Uv=$this->getDoctrine()->getRepository('UserBundle:Produit')->find($id);
        return $this->render( 'KidsFrontBundle::details.html.twig',array('form'=>$Uv));

    }



    public function RechercherProduitFrontAction(Request $request)
    {

        $search = $request->query->get('search');
        $produit= $this->getDoctrine()->getRepository('UserBundle:Produit')->findBy(array('nomProduit'=>$search));

        if (strlen($search)!=0){

            return $this->render('@KidsFront/RechercherProduitFront.html.twig',array('produit'=>$produit));

        } else {
            return  $this->redirectToRoute('@KidsFront/ProduitAfficherFront.html.twig');
        }
    }
    public function CategorieProduitAction($id)
    {
        $produit= $this->getDoctrine()->getRepository('UserBundle:Produit')->find($id);
        return $this->render('KidsFrontBundle::CategorieProduit', array('form'=>$produit));
    }

}
