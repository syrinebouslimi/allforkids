<?php

namespace UserBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Entity\Enseignant;
use UserBundle\Entity\Etablissement;

class EnseignantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['data'];
//                    var_dump($user);
//            die($user);

        $builder
            ->add('nomEnseignant')
            ->add('prenomEnseignant')
            ->add('adresseEnseignant')
            ->add('codePostalEnseignant')
            ->add('countryEnseignant',ChoiceType::class,array('choices'=>array('à 08h:00'=>'à 08h:00','à 09h:00'=>'à 09h:00'
    ,'à 10h:00'=>'à 10h:00','à 11h:00'=>'à 11h:00','à 12h:00'=>'à 12h:00','à 13h:00'=>'à 13h:00','à 14h:00'=>'à 14h:00'
    ,'à 15h:00'=>'à 15h:00','à 16h:00'=>'à 16h:00','à 17h:00'=>'à 17h:00')))
            ->add('regionEnseignant')
            ->add('imageEnseignant',FileType::class)
            ->add('aboutEnseignant', TextareaType::class)
            ->add('designationEnseignant')
            ->add('diplomeEnseignant')
            ->add('experienceEnseignant')
            ->add('hobbiesEnseignant')
            ->add('coursEnseignant')
            ->add('etablissementId',EntityType::class,array('class'=>'UserBundle:Etablissement','choice_label'=>'nomEtablissement'

                ,'query_builder' => function(EntityRepository $er) use ($user)
                    {
                        return $er->createQueryBuilder('s')
                            ->where('s.idUserEtablissement = :idUser')
                            ->setParameter('idUser', $user);

                    }

                )




            )



            ->add('AjouterEnseignant', SubmitType::class,array('label' => 'Ajouter Enseignant'))
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Enseignant'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_enseignant';
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Enseignant::class,
        ));
    }




}
