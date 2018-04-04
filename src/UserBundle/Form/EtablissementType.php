<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtablissementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomEtablissement')
            ->add('descriptionEtablissement', TextareaType::class)
            ->add('cityEtablissement')
            ->add('adresseEtablissement')
            ->add('codepostalEtablissement')
            ->add('regionEtablissement')
            ->add('countryEtablissement',ChoiceType::class,array('choices'=>array('à 08h:00'=>'à 08h:00','à 09h:00'=>'à 09h:00'
            ,'à 10h:00'=>'à 10h:00','à 11h:00'=>'à 11h:00','à 12h:00'=>'à 12h:00','à 13h:00'=>'à 13h:00','à 14h:00'=>'à 14h:00'
            ,'à 15h:00'=>'à 15h:00','à 16h:00'=>'à 16h:00','à 17h:00'=>'à 17h:00')))
            ->add('exigenceEtablissement', TextareaType::class)
            ->add('imageEtablissement',FileType::class, array("label" => "Files",
                'required' => false,
                'multiple' => true))
            ->add('horaireEtablissement',ChoiceType::class,array('choices'=>array('à 08h:00'=>'à 08h:00','à 09h:00'=>'à 09h:00'
            ,'à 10h:00'=>'à 10h:00','à 11h:00'=>'à 11h:00','à 12h:00'=>'à 12h:00','à 13h:00'=>'à 13h:00','à 14h:00'=>'à 14h:00'
            ,'à 15h:00'=>'à 15h:00','à 16h:00'=>'à 16h:00','à 17h:00'=>'à 17h:00')))
            ->add('AjouterEtablissement',SubmitType::class,array('label'=>'Ajouter Etablissement'));

        ;

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Etablissement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_etablissement';
    }


}
