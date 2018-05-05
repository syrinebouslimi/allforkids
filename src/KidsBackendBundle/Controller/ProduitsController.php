<?php

namespace KidsBackendBundle\Controller;


use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\CategorieProduit;
use UserBundle\Entity\Produit;
use UserBundle\Form\CategorieProduitType;
use UserBundle\Form\ProduitType;


class ProduitsController extends Controller
{


    public function ajouterProduitAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();
        $rec = new Produit();
        $form=$this->createForm(ProduitType::class,$rec);
        $formView=$form->createView();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())

        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($rec);


            // $file stores the uploaded PDF file

            $file = $rec->getImageProduit();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('images_directory'),
                $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $rec->setImageProduit($fileName);


            $em->flush();

            return $this->redirect($this->generateUrl('afficherProduit'));
        }


        return $this->render ( '@KidsBackend/ajouterProduit.html.twig',array('form'=>$formView, 'notifiableNotifications' => $allNotif));


    }


    public function afficherProduitAction()
    {
        $em = $this->getDoctrine()->getManager();

        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();
        $Uv = $this->getDoctrine()->getRepository('UserBundle:Produit')->findAll();
        return $this->render('@KidsBackend/afficherProduit.html.twig', array('form' => $Uv, 'notifiableNotifications' => $allNotif));
    }

    public function supprimerProduitAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();

        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();
        $em = $this->getDoctrine()->getManager();
        $Pro = $this->getDoctrine()->getRepository('UserBundle:Produit')->find($id);

        $em->remove($Pro);
        $em->flush();
        return $this->forward('KidsBackendBundle:Produits:afficherProduit', array('form' => $Pro, 'notifiableNotifications' => $allNotif));

    }

    public function ajouterCategAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();
        $cat = new CategorieProduit();

        $form=$this->createForm(CategorieProduitType::class, $cat);
        $formView=$form->createView();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())

        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($cat);
            $em->flush();
            return $this->redirect($this->generateUrl('afficherCateg'));

        }


        return $this->render('@KidsBackend/ajouterCategorie.html.twig',array('form'=>$formView, 'notifiableNotifications' => $allNotif));


    }

    public function afficherCategAction ()

    {
        $em = $this->getDoctrine()->getManager();

        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();
        $Uv=$this->getDoctrine()->getRepository('UserBundle:CategorieProduit')->findAll();
        return $this->render ( '@KidsBackend/afficherCategorie.html.twig',array('form'=>$Uv, 'notifiableNotifications' => $allNotif));

    }
    function rechercherProduitAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();
        $pro=new Produit();
        $em=$this->getDoctrine()->getManager();
        $produits=$em->getRepository('UserBundle:Produit')->findAll();
       if ($request->isMethod('POST')){
           $nomProduit=$request->get('nomProduit');
           $produits=$em->getRepository('UserBundle:Produit')->findBy(array("nomProduit"=>$nomProduit));

    }
        return $this->render('@KidsBackend/rechercherProduit.html.twig',array('produits'=>$produits, 'notifiableNotifications' => $allNotif));

    }

public function modifierProduitAction(Request $request,$id)
{
    $em = $this->getDoctrine()->getManager();

    $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();
    $Uvn = $this->getDoctrine()->getRepository('UserBundle:Produit')->find($id);
    $Uvn->setImageProduit(null);
    $form = $this->createForm(ProduitType::class, $Uvn);
    $formView = $form->createView();
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($Uvn);

        //update image

        $file = $Uvn->getImageProduit();

        // Generate a unique name for the file before saving it
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();

        // Move the file to the directory where brochures are stored
        $file->move(
            $this->getParameter('images_directory'),
            $fileName
        );

        // Update the 'brochure' property to store the PDF file name
        // instead of its contents
        $Uvn->setImageProduit($fileName);


        // update image

        $em->flush();
        return $this->redirect($this->generateUrl('afficherProduit'));
    }


    return $this->render('@KidsBackend/ajouterProduit.html.twig', array('form' => $formView, 'notifiableNotifications' => $allNotif));
}

    public  function stataction()
    {
        $em = $this->getDoctrine()->getManager();

        $allNotif = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();

        $pieChart = new PieChart();
        $em = $this->getDoctrine()->getManager();

        $categories=$em->getRepository('UserBundle:CategorieProduit')->findAll();
        $produits = $em->getRepository('UserBundle:Produit')->findAll();


        $catPro = array(array("Nom catégorie","nombre"));

        foreach ($categories as $cat ){
            $count = 0 ;

            foreach ($produits as $pro){

                if ($pro->getIdCategorieProduit() == $cat ) {

                    $count = $count + 1;

                }
                $nomCategorie = $cat->getNomCategorie();
            }

            array_push($catPro,array($nomCategorie, $count));


        }

        $pieChart->getData()->setArrayToDataTable($catPro);





        $pieChart->getOptions()->setTitle('Pourcentages des produit par categorie');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('@KidsBackend/stat.html.twig', array(
            'piechart'=>$pieChart,
            'notifiableNotifications' => $allNotif

        ));
    }
}

