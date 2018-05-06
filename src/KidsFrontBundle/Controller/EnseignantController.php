<?php

namespace KidsFrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Enseignant;
use UserBundle\Form\EnseignantType;

class EnseignantController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function afficherprofAction()
    {

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();


        $etablissementId = $this->getDoctrine()->getRepository('UserBundle:Etablissement')->findOneBy(array('idUserEtablissement' => $id));
        $enseignants = $this->getDoctrine()->getRepository('UserBundle:Enseignant')->findBy(array('etablissementId' => $etablissementId));

        return $this->render('@KidsFront/afficherprofprestataire.html.twig', array('enseignants' => $enseignants));

    }

    public function afficherdetailprofAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $enseignant = $this->getDoctrine()->getRepository('UserBundle:Enseignant')->find($id);

        return $this->render('@KidsFront/teacherdetail.html.twig', array('enseignant' => $enseignant));


    }

    public function ajouterEnseignantAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();
        $user = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $etablis = $em->getRepository('UserBundle:Etablissement')->findBy(
            array(
                'idUserEtablissement' => $user
            ));
        $enseignant = new Enseignant();

        $form = $this->createForm(EnseignantType::class, $enseignant);

        $formview = $form->createView();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $imagefile = $enseignant->getImageEnseignant();
            $fileName = md5(uniqid()) . '.' . $imagefile->guessExtension();
            $imagefile->move(
                $this->getParameter('images_directory'),
                $fileName
            );


            $enseignant->setImageEnseignant($fileName);

            $etablisNew = $em->getRepository('UserBundle:Etablissement')->find($request->get('idEtab'));

            $enseignant->setEtablissementId($etablisNew);

            $save = $this->getDoctrine()->getManager();
            $save->persist($enseignant);
            $save->flush();
            return $this->redirectToRoute('afficherprof');

        }

        return $this->render('@KidsFront/ajouterenseignant.html.twig', array('form' => $formview, 'e' => $etablis));

    }

    public function afficherprofpourmodifierAction()
    {

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();


        $etablissementId = $this->getDoctrine()->getRepository('UserBundle:Etablissement')->findOneBy(array('idUserEtablissement' => $id));
        $enseignants = $this->getDoctrine()->getRepository('UserBundle:Enseignant')->findBy(array('etablissementId' => $etablissementId));

        return $this->render('@KidsFront/afficherenseignantspourmodifier.html.twig', array('enseignants' => $enseignants));

    }

    public function modifierenseignantbyidAction(Request $request, $id)
    {


        $user = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $etablis = $em->getRepository('UserBundle:Etablissement')->findBy(
            array(
                'idUserEtablissement' => $user
            ));

        $enseignant = $this->getDoctrine()->getRepository('UserBundle:Enseignant')->find($id);
        $imageOld = $enseignant->getImageEnseignant();

        $form = $this->createForm(EnseignantType::class, $enseignant);
        $formView = $form->createView();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $imagefile = $enseignant->getImageEnseignant();

            if (is_null($imagefile)) {
                $enseignant->setImageEnseignant($imageOld);
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                return $this->redirectToRoute('afficherprof');
            } else
                if (!is_null($imagefile)) {
                    $fileName = md5(uniqid()) . '.' . $imagefile->guessExtension();

                    $imagefile->move(
                        $this->getParameter('images_directory'),
                        $fileName
                    );


                    $enseignant->setImageEnseignant($fileName);

                    $em = $this->getDoctrine()->getManager();
                    $em->flush();
                    return $this->redirectToRoute('afficherprof');
                }
        }
        return $this->render('@KidsFront/ajouterenseignant.html.twig', array('form' => $formView, 'e' => $etablis));
    }

    public function afficherprofpoursupprimerAction()
    {

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();


        $etablissementId = $this->getDoctrine()->getRepository('UserBundle:Etablissement')->findOneBy(array('idUserEtablissement' => $id));
        $enseignants = $this->getDoctrine()->getRepository('UserBundle:Enseignant')->findBy(array('etablissementId' => $etablissementId));

        return $this->render('@KidsFront/afficherenseignantspoursupprimer.html.twig', array('enseignants' => $enseignants));

    }

    public function supprimersenseignantparidAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $enseig = $this->getDoctrine()->getRepository('UserBundle:Enseignant')->find($id);
        $em->remove($enseig);

        $em->flush();
        return $this->redirectToRoute('afficherprof');
    }


}
