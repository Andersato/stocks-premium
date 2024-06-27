<?php

namespace App\Form\Statistic;

use App\Repository\Filters\Statistics\EpsYYTtmFilter;
use App\Repository\Filters\Statistics\PerfWeekFilter;
use App\Repository\Filters\Statistics\PerfYearFilter;
use App\Repository\Filters\Statistics\PerfYtdFilter;
use App\Repository\Filters\Statistics\PriceFilter;
use App\Repository\Filters\Statistics\SalesQQFilter;
use App\Repository\Filters\Statistics\SalesYYTtmFilter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class SalesQQFilterFormType extends AbstractType
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
                ],
            ])
            ->add('maxValue', IntegerType::class, [
                'required' => false,
                'label' => 'Max',
                'attr' => [
                    'placeholder' => '250',
                    'max' => 250
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SalesQQFilter::class,
        ]);
    }
}