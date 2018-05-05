<?php

namespace UserBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomPublication')
            ->add('contenuPublication', FileType::class,  array('data_class' => null,'required' => false))
            ->add('imagePublication', FileType::class,  array('data_class' => null,'required' => false))
            ->add('etatPublication', ChoiceType::class, array('choices'=>array('Publié'=>'Publié', 'Non Publié'=>'Non Publié')))
            ->add('datePublication', DateType::class, array('widget' => 'single_text',))
            ->add('descriptionPublication', CKEditorType::class)
            ->add('idUserPublication', HiddenType::class)
            ->add('typePublication', EntityType::class, array('class'=>'UserBundle\Entity\TypePublication', 'choice_label'=>'nomTypePublication') )
            ->add('categoriePublication', EntityType::class, array('class'=>'UserBundle\Entity\CategoriePublication', 'choice_label'=>'nomCategPublication'))
            ->add('Valider',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Publication'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_publication';
    }


}
