<?php

namespace App\Form;

use App\Entity\Cheval;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class LinkHorseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', EntityType::class, [
                'label' => 'Selection du Cheval : ',
                'mapped' => false,
                'class' => Cheval::class,
                'choice_label' => 'nom'
            ])
            ->add('id', EntityType::class, [
                'label' => 'Selection du Client : ',
                'mapped' => false,
                'class' => User::class,
                'choice_label' => 'firstName',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.status = :ustatus')
                        ->setParameter('ustatus', "ok");
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cheval::class,
        ]);
    }
}