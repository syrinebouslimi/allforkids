<?php

namespace UserBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AffectinClubType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idClub',EntityType::class ,array('class'=>'UserBundle\Entity\Club','choice_label'=>'nomClub'))
            ->add('idUserParent',EntityType::class ,array('class'=>'UserBundle\Entity\User','choice_label'=>'nomUser'))
            ->add('idEnfant',EntityType::class ,array('class'=>'UserBundle\Entity\Enfants','choice_label'=>'nomEnfant'))
        ->add('Affecter',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\AffectinClub'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_affectinclub';
    }


}
