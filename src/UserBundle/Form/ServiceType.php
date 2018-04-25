<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use  Symfony\Bridge\Doctrine\Form\Type\
EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class ServiceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomService')->add('descriptionService')
            ->add('adresseService')->add('contact')
            ->add('idTypeService',EntityType::class ,array('class'=>'UserBundle\Entity\TypeService','choice_label'=>'nomTypeService'))
            ->add('imagServ', FileType::class,array('data_class' => null),array('label' => '(Image JPG)'))
            ->add('Register',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Service'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_service';
    }


}
