<?php

namespace App\Task\Infrastructure\Framework\Form;

use App\Common\Infrastructure\Framework\Form\Select2FormType;
use App\Task\Infrastructure\Framework\Form\Model\TaskFormModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\RouterInterface;

class TaskFormType extends AbstractType
{
    public function __construct(private readonly RouterInterface $router)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('taskName', Select2FormType::class, [
            'required' => true,
            'multiple' => true,
            'attr' => [
                'data-autocomplete-url' => $this->router->generate('app_find_task'),
            ],
            'choices' => []
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => TaskFormModel::class]);
    }
}
