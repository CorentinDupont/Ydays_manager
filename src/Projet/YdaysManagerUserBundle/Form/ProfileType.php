<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 07/01/2018
 * Time: 19:13
 */

namespace Projet\YdaysManagerUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // add your custom field
        $builder->add('lastName')
            ->add('profilePictureFile');

    }

    public function getParent()
    {
        return 'fos_user_profile';
    }
}
