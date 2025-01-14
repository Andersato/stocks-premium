<?php

namespace App\Form\Statistic;

use App\Repository\Filters\Statistics\PriceFilter;
use App\Utils\Utils;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class PriceFilterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('minValue', IntegerType::class, [
                'required' => false,
                'label' => 'Min',
                'attr' => [
                    'placeholder' => $options['min'],
                ],
            ])
            ->add('maxValue', IntegerType::class, [
                'required' => false,
                'label' => 'Max',
                'attr' => [
                    'placeholder' => $options['max'],
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PriceFilter::class,
            'min' => [],
            'max' => [],
        ]);
    }
}
