<?php


/**
 * Description of RegistrationFormType
 *
 * @author krzysiek
 */

namespace Kwejk\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('firstname', null,array('label' => 'Imię'))
                ->add('lastname', null,array('label' => 'Nazwisko'))
        ;
    }
    public function getParent()
    {
        return 'kwejk_user_registration';
    }
    public function getName()
    {
        return 'kwejk_user_registration';
    }
}
