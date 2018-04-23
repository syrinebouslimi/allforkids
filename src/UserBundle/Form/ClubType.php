<?php

namespace UserBundle\Form;

use Ivory\GoogleMapBundle\Form\Type\PlaceAutocompleteType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClubType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomClub')
            ->add('descriptionClub')
            ->add('dateCreationClub')
            ->add('imageClub', FileType::class, array('label' => '(Image JPG)'))
            ->add('adresse', PlaceAutocompleteType::class, ['variable' => 'place_autocomplete',])
            ->add('long')
            ->add('lat')
            ->add('idEtablissement',EntityType::class ,array('class'=>'UserBundle\Entity\Etablissement','choice_label'=>'nomEtablissement'))
        ->add('Register',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Club'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_club';
    }


}
