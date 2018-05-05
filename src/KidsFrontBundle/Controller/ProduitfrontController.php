<?php

namespace KidsFrontBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use UserBundle\Entity\Produit;


class ProduitfrontController extends Controller
{
    public function ProduitAfficherFrontAction()
    {

        $Uv = $this->getDoctrine()->getRepository('UserBundle:Produit')->findAll();
        $categories = $this->getDoctrine()->getRepository('UserBundle:CategorieProduit')->findAll();
        return $this->render('@KidsFront/ProduitAfficherFront.html.twig', array('form' => $Uv, 'categories'=>$categories));
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



    public function rechercheAction(Request $request)
    {

        $search = $request->query->get('search');
        $servi= $this->getDoctrine()->getRepository('UserBundle:Produit')->findBy(array('nomProduit'=>$search));
        if (strlen($search)!=0){

            return $this->render('@KidsFront/ProduitAfficherFront.html.twig',array('serv'=>$servi));

        } else {
            return  $this->redirectToRoute('KidsFrontBundle:Produitfront:ProduitAfficherFront');
        }
    }
    public function CategorieProduitAction($id)
    {
        $produit= $this->getDoctrine()->getRepository('UserBundle:Produit')->find($id);
        return $this->render('KidsFrontBundle::CategorieProduit', array('form'=>$produit));
    }

    public function produitParCategorieAction($id)
    {
        $produits = $this->getDoctrine()->getRepository('UserBundle:Produit')->findBy(array('idCategorieProduit'=>$id));
        $categories = $this->getDoctrine()->getRepository('UserBundle:CategorieProduit')->findAll();

        return $this->render('@KidsFront/produitParCategorie.html.twig', array('produits' => $produits, 'categories'=>$categories));
    }
//affichageMobile
    public function afficherProduitjsonFrontAction ()

    {
        $Uv=$this->getDoctrine()->getRepository('UserBundle:Produit')->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($Uv);
        return new JsonResponse($formatted);
    }

    public function afficherCategoriejsonFrontAction ()

    {
        $Uv=$this->getDoctrine()->getRepository('UserBundle:CategorieProduit')->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($Uv);
        return new JsonResponse($formatted);
    }
//ajouterMobile
    public function ajoutProduitjsonAction (Request $request)

    {
        $em=$this->getDoctrine()->getManager();
        $Produits=new Produit();
        $Produits->setNomProduit($request->get('nomProduit'));
        $Produits->setDescriptionProduit($request->get('descriptionProduit'));
        $Produits->setPrixProduit($request->get('prixProduit'));
        $Produits->setQuantiteProduit($request->get('quantiteProduit'));
        $Produits->setImageProduit($request->get('imageProduit'));
        // $services->setIdTypeService($request->get('idTypeService'));
        //  $services->setIdUserService($request->get('idUserService'));

        $em->persist($Produits);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($Produits);
        return new JsonResponse($formatted);
    }


}
