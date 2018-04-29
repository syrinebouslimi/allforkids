<?php
/**
 * Created by PhpStorm.
 * User: Syrine
 * Date: 01/04/2018
 * Time: 20:46
 */

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;



class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adresseUser')
            ->add('profilePictureUser')
            ->add('numeroTelephoneUser')
            ->add('nomUser')
            ->add('prenomUser')
            ->add('roles', ChoiceType::class, array('label' => 'Rôle',
                'choices' => array('Parent' => 'ROLE_PARENT', 'Prestataire de service ' => 'ROLE_PRESTATAIRE'),
                'required' => true, 'multiple' => true,
            ));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

}

