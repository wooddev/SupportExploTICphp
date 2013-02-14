<?php
// src/Explotic/AdminBundle/Form/Type/RegistrationFormType.php


namespace Explotic\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder->add('entreprise');
    }

    public function getName()
    {
        return 'explotic_user_registration';
    }
}

?>