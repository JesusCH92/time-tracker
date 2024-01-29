<?php

namespace App\TaskTime\Infrastructure\Framework\Form;

use App\TaskTime\Infrastructure\Framework\Form\Model\TimeFormModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TimeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start', SubmitType::class, [
                'label' => 'Empezar',
                'attr' => ['class' => 'btn btn-primary'],
            ])
            ->add('end', SubmitType::class, [
                'label' => 'Detener',
                'attr' => ['class' => 'btn btn-secondary'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => TimeFormModel::class]);
    }
}
