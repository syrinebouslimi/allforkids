<?php

namespace UserBundle\Form;

use blackknight467\StarRatingBundle\Form\RatingType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('nomEtablissement',TextType::class)
            ->add('descriptionEtablissement', TextareaType::class)
            ->add('phone',TextType::class)
            ->add('cityEtablissement',TextType::class)
            ->add('adresseEtablissement',TextType::class)
            ->add('codepostalEtablissement',TextType::class)
            ->add('regionEtablissement',TextType::class)
            ->add('countryEtablissement',ChoiceType::class,array('choices'=>array('Tunisie'=>'Tunisie','USA'=>'USA'
            ,'France'=>'France','Algérie'=>'Algérie')))
            ->add('exigenceEtablissement', TextareaType::class)
            ->add('imageEtablissement',FileType::class, array("label" => "Files",'data_class'=>null,
                'required' => false,
                'multiple' => false))
            ->add('horaireEtablissement',ChoiceType::class,array('choices'=>array('8:30am-5:30pm'=>'8:30am-5:30pm','9:30am-5:30pm'=>'9:30am-5:30pm'
            ,'7:30am-4:30pm'=>'7:30am-4:30pm','9:00am-5:00pm'=>'9:00am-5:00pm','8:00am-4:00pm'=>'8:00am-4:00pm')))
            ->add('typeEtablissement',ChoiceType::class,array('choices'=>array('Créche'=>'Créche','Jardin denfants'=>'Jardin denfants','Garderie'
            =>'Garderie','Ecole'=>'Ecole')))
            ->add('Valider',SubmitType::class,array('label'=>'Enregistrer'));

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
