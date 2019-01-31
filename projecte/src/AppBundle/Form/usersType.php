<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use AppBundle\Entity\users;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;

class usersType extends AbstractType
{
  /**
   * {@inheritdoc}
   */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
          ->add('nombre', TextType::class)
          ->add('apellidos', TextType::class)
          ->add('email', EmailType::class)
          ->add('username', TextType::class)
          ->add('plainPassword', RepeatedType::class, [
              'type' => PasswordType::class,
              'first_options'  => ['label' => 'Contraseña'],
              'second_options' => ['label' => 'Repite contraseña'],
          ])
          ->add('borrar', ResetType::class, array('label' => 'Limpiar'));
  }/**
   * {@inheritdoc}
   */
  public function configureOptions(OptionsResolver $resolver)
{
  $resolver->setDefaults(array(
      'data_class' => 'AppBundle\Entity\users'
  ));
}
}
