<?php

namespace KidsFrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\Service;


class ServicesController extends Controller
{

    public function servicesAction(Request $request)
    {
        $Uv=$this->getDoctrine()->getRepository('UserBundle:Service')->findAll();
        $dql="SELECT id FROM UserBundle:Service id";
       /* $query=$Uv->createQuery($dql);

        if ($request->query->getAlnum('filter')) {
            $query
                ->where('id.nomService LIKE :nomService')
                ->setParameter('title', '%' . $request->query->getAlnum('filter') . '%');
        }*/



        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator  = $this->get('knp_paginator');
        $result=$paginator->paginate(
           // $query,
            $Uv,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit',4)
        );





        return $this->render ( '@KidsFront/services.html.twig',array('serv'=>$result));


    }


    public function rechercheAction(Request $request)
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

            return $this->render('@KidsFront/services.html.twig',array('serv'=>$result));

        } else {
            return  $this->redirectToRoute('KidsFrontBundle:Services:services');
        }
    }



//Affichage

    public function afficherServiceFrontAction ()

    {
        $Uv=$this->getDoctrine()->getRepository('UserBundle:Service')->findAll();
        return $this->render ( '@KidsFront/afficherServiceFront.html.twig',array('serv'=>$Uv));

    }

    public function afficheServFrontAction ()

    {
        $Uv=$this->getDoctrine()->getRepository('UserBundle:Service')->findAll();
        return $this->render ( '@KidsFront/afficheServ.html.twig',array('serv'=>$Uv));

    }

    public function detailServiceFrontAction ($id)

    {
        $Uv=$this->getDoctrine()->getRepository('UserBundle:Service')->find($id);
        return $this->render( '@KidsFront/detail2sevice.html.twig',array('serv'=>$Uv));

    }

    public function rendezvousAction ($id)

    {


    }

}
