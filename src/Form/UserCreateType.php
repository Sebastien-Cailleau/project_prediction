<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserCreateType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add(
        'email',
        EmailType::class,
        [
          'label' => 'Adresse mail'
        ]
      )
      ->add('name',
            TextType::class,
            [
              'label' => 'Pseudo'
            ]
      )
      ->add('plainPassword', RepeatedType::class, array(
        'type' => PasswordType::class,
        'invalid_message' => 'Les deux mot de passe ne sont pas identique',
        'first_options'  => array('label' => 'Mot de passe'),
        'second_options' => array('label' => 'Repeter le mot de passe'),
      ));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => User::class,
    ]);
  }
}
