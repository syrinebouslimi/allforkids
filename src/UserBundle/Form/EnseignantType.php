<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\SecurityContext;

// ne pas oublier

class EnseignantType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$user = $this->getUser();
//                    var_dump($user);
//            die($user);

        $builder
            ->add('nomEnseignant')
            ->add('prenomEnseignant')
            ->add('phoneEnseignant')
            ->add('emailEnseignant')
            ->add('adresseEnseignant')
            ->add('imageEnseignant', FileType::class,array("label" => "Files",'data_class' => null,
                'required' => false,
                'multiple' => false))
            ->add('aboutEnseignant', TextareaType::class)


            ->add('designationEnseignant',ChoiceType::class, array('choices'=>array('Professeurs des écoles'=>'Professeurs des écoles',
        'Agrégés'=>'Agrégés',
        'Certifiés'=>'Certifiés'
    )))


            ->add('diplomeEnseignant',ChoiceType::class, array('choices'=>array('Licence'=>'Licence',
                'Licence professionnelle'=>'Licence professionnelle',
                'Diplôme national de technologie spécialisé'=>'Diplôme national de technologie spécialisé',
                'Master professionnel'=>'Master professionnel',
                'Master recherche'=>'Master Recherche',
                'Diplôme Ingénieur'=>'Diplôme Ingénieur'
                )))
            ->add('experienceEnseignant',ChoiceType::class, array('choices'=>array('0 ans à 2 ans dans un etablissement educatif'=>'0 ans à 2 ans dans un etablissement educatif',
                '2 ans à 4 ans dans un etablissement educatif'=>'2 ans à 4 ans dans un etablissement educatif',
                '4 ans à 6 ans dans un etablissement educatif'=>'4 ans à 6 ans dans un etablissement educatif'
            )))

            ->add('hobbiesEnseignant',ChoiceType::class, array('choices'=>array('Lecture'=>'Lecture',
                'Musique'=>'Musique',
                'Dance'=>'Dance',
                'Sport'=>'Sport'
            )))
            ->add('coursEnseignant',ChoiceType::class, array('choices'=>array('Français'=>'Français',
                'Anglais'=>'Anglais',
                'Arabe'=>'Arabe',
                'Mathématique'=>'Mathématique',
            )))



            ->add('submit', SubmitType::class, array('label' => 'Enregistrer'));
    }

    /**
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

//    public function setDefaultOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults(array(
//            'data_class' => Enseignant::class,
//        ));
//    }


}
