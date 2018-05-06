<?php

namespace UserBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomProduit')
            ->add('descriptionProduit')
            ->add('prixProduit')
            ->add('quantiteProduit')
            ->add('imageProduit',FileType::class,array ('label' => '(Image JPG)'))
            ->add('idUserProduit')
            ->add('idCategorieProduit',EntityType::class ,array('class'=>'UserBundle\Entity\CategorieProduit','choice_label'=>'nomCategorie'))
            ->add('Register',SubmitType::class)

        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Produit'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_produit';
    }


}
