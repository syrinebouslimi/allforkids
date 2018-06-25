<?php

namespace KidsFrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\UserEtablissementVote;

class ParentController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function espaceParentAction()
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $idUser = $user->getId();

        $em = $this->getDoctrine()->getManager();
        $allFavoris = $em->getRepository('UserBundle:UserEtablissementFavoris')->findBy(array('user' => $idUser));

        return $this->render('@KidsFront/espaceparent.html.twig', array('favoris' => $allFavoris));

    }

    public function afficherEnseignParentAction(){


        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $idUser = $user->getId();

        $em = $this->getDoctrine()->getManager();
        $allFavoris = $em->getRepository('UserBundle:UserEtablissementFavoris')->findBy(array('user' => $idUser));
        $allEnsei = $em->getRepository('UserBundle:Enseignant')->findAll();

        $allEtab = $em->getRepository('UserBundle:Etablissement')->findBy(array('etat' => 'valide'));


        return $this->render('@KidsFront/afficherenseiparparent.html.twig', array('favoris' => $allFavoris,
            'enseignants'=>$allEnsei, 'etablissement'=>$allEtab));
    }


    public function afficherFiltredEnseignParentAction(Request $request){


        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $idUser = $user->getId();

        $em = $this->getDoctrine()->getManager();
        $allFavoris = $em->getRepository('UserBundle:UserEtablissementFavoris')->findBy(array('user' => $idUser));
        $idEtab = $request->get('idEtab');

        if ($idEtab == "Voir tout"){
            return $this->redirectToRoute('afficherEnseignParent');
        } else{

            $filtredEnsei = $em->getRepository('UserBundle:Enseignant')->findBy(array('etablissementId'=>$idEtab));
            $allEtab = $em->getRepository('UserBundle:Etablissement')->findBy(array('etat' => 'valide'));



            return $this->render('@KidsFront/afficherenseiparparent.html.twig', array('favoris' => $allFavoris,
                'enseignants'=>$filtredEnsei, 'etablissement'=>$allEtab));
        }



    }


    public function afficherGallerieParentAction(){

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $idUser = $user->getId();

        $em = $this->getDoctrine()->getManager();
        $allFavoris = $em->getRepository('UserBundle:UserEtablissementFavoris')->findBy(array('user' => $idUser));
        $allGallerie = $em->getRepository('UserBundle:Gallerie')->findAll();

        return $this->render('@KidsFront/affichergallerieparent.html.twig', array('favoris' => $allFavoris,
            'gallerie'=>$allGallerie));
    }


    public function afficherEtabParentAction()
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $idUser = $user->getId();

        $em = $this->getDoctrine()->getManager();


        $allFavoris = $em->getRepository('UserBundle:UserEtablissementFavoris')->findBy(array('user' => $idUser));
        $allEtab = $em->getRepository('UserBundle:Etablissement')->findAll();

        foreach($allEtab as $e) {

            $query = $em->createQueryBuilder();
            $query->select('avg(o.vote) AS vote');
            $query->from('UserBundle:UserEtablissementVote', 'o');
//            $query->where('o.user = :userId');
//            $query->setParameter('userId', $idUser);
            $query->where('o.etablissement = :etabId');

            $query->setParameter('etabId', $e->getId());

            $a = $query->getQuery();

            $result = $a->getResult();
            $e->setAvgRating($result[0]['vote']);



            $save = $this->getDoctrine()->getManager();
            $save->persist($e);
            $save->flush();


        }


        return $this->render('@KidsFront/afficheretablissementparent.html.twig', array('etablissement' => $allEtab, 'favoris' => $allFavoris));

    }

    public function ajouterOuModifierVoteAction(Request $request,$id){
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $idUser = $user->getId();

        $em = $this->getDoctrine()->getManager();
        $vote =$request->get('vote');

        $etabli = $this->getDoctrine()->getRepository('UserBundle:Etablissement')->find($id);
        $save = $this->getDoctrine()->getManager();

        $existantUserVote = $this->getDoctrine()->getRepository('UserBundle:UserEtablissementVote')->findOneBy(array('user'=>$idUser,'etablissement'=>$id));
        if ($existantUserVote != null){
            $existantUserVote->setVote((int)$vote);
            $save->flush();


        }else{
            $newvote = new UserEtablissementVote();
            $newvote->setVote((int)$vote);
            $newvote->setEtablissement($etabli);
            $newvote->setUser($user);


            $save->persist($newvote);
            $save->flush();

        }

        return $this->redirectToRoute('afficherEtabById',array('id'=>$id));


    }


}
