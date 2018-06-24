<?php

namespace KidsFrontBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use UserBundle\Entity\CategorieProduit;
use UserBundle\Entity\Produit;
use UserBundle\Form\ProduitType;
use UserBundle\Form\SearchProductType;


class ProduitfrontController extends Controller
{
    public function ProduitAfficherFrontAction(Request $request)
    {

        $form = $this->createForm(SearchProductType::class);
        $form->handleRequest($request);

        $Uv = $this->getDoctrine()->getRepository('UserBundle:Produit')->findAll();
        $categories = $this->getDoctrine()->getRepository('UserBundle:CategorieProduit')->findAll();

        if ($request->getMethod() == 'POST') {
            //$form->submit($request);


            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                //On récupère les données entrées dans le formulaire par l'utilisateur

                $data = $request->get('userbundle_produit');


                //On va récupérer la méthode dans le repository afin de trouver toutes les annonces filtrées par les paramètres du formulaire

                $liste_produit = $em->getRepository('UserBundle:Produit')->findProductByParametres($data);

                //Puis on redirige vers la page de visualisation de cette liste d'annonces


                return $this->render('@KidsFront/Default/rechercheProduit.html.twig', array(
                    'liste_produit' => $liste_produit, 'formP' => $form->createView(),
                ));

            }

        }


        return $this->render('@KidsFront/ProduitAfficherFront.html.twig', array('form' => $Uv, 'categories'=>$categories
        , 'formP' => $form->createView()));
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
        $produits=new Produit();
        $produits->setId($request->get('id'));
        $produits->setNomProduit($request->get('nomProduit'));
        $produits->setDescriptionProduit($request->get('descriptionProduit'));
        $produits->setPrixProduit($request->get('prixProduit'));
        $produits->setQuantiteProduit($request->get('quantiteProduit'));
        $produits->setImageProduit($request->get('imageProduit'));
        $type = $request->get('idCategorieProduit');


        $typeser= $this->getDoctrine()->getRepository('UserBundle:CategorieProduit')->find($type) ;



        $produits->setIdCategorieProduit($typeser);


        $em->persist($produits);
        $em->flush();

//        $serializer = new Serializer([new ObjectNormalizer()]);
//        $formatted= $serializer->normalize($produits);
//        return new JsonResponse($formatted);

        $Uv=$this->getDoctrine()->getRepository('UserBundle:Produit')->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($Uv);
        return new JsonResponse($formatted);
    }

    public function ajoutCategoriejsonAction (Request $request)

    {
        $em=$this->getDoctrine()->getManager();
        $Categorieproduit=new CategorieProduit();

        //$Categorieproduit->setId($request->get('id'));
        $Categorieproduit->setNomCategorie($request->get('nomCategorie'));







        $em->persist($Categorieproduit);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($Categorieproduit);
        return new JsonResponse($formatted);
    }

    //supprimerMobile

    public function supprimerProduitJsonAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $Produit = $this->getDoctrine()->getRepository('UserBundle:Produit')->find($id);
        $em->remove($Produit);
        $em->flush();
        return new \Symfony\Component\HttpFoundation\Response("Suppression effectué avec succés");
    }
}

