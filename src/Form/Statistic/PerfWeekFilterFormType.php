<?php

namespace App\Form\Statistic;

use App\Repository\Filters\Statistics\PerfWeekFilter;
use App\Repository\Filters\Statistics\PriceFilter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class PerfWeekFilterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('minValue', IntegerType::class, [
                'required' => false,
                'label' => 'Min',
                'attr' => [
                    'placeholder' => '-50',
                    'min' => -50,
                    'class' => 'input-half'
                ],
            ])
            ->add('maxValue', IntegerType::class, [
                'required' => false,
                'label' => 'Max',
                'attr' => [
                    'placeholder' => '250',
                    'max' => 250,
                    'class' => 'input-half'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PerfWeekFilter::class,
        ]);
    }
}
