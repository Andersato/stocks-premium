<?php

namespace App\Form\Statistic;

use App\Repository\Filters\Statistics\RangeFilter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class
RangeFilterFormType extends AbstractType
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('minValue', NumberType::class, [
                'required' => false,
                'label' => 'Minimum Price',
            ])
            ->add('maxValue', NumberType::class, [
                'required' => false,
                'label' => 'Maximum Price',
            ]);

//        $builder
//            ->add('sector', ChoiceType::class, [
//                'choices' => $this->getSectors(),
//                'attr' => [
//                    'class' => 'select-filter',
//                    'data-type' => 'sector'
//                ]
//            ])
//            ->add('marketCap', ChoiceType::class, [
//                'choices' => $this->getMarketCaps(),
//                'attr' => [
//                    'class' => 'select-filter',
//                    'data-type' => 'marketCap'
//                ]
//            ])
//            ->add('per', ChoiceType::class, [
//                'choices' => $this->getPers(),
//                'attr' => [
//                    'class' => 'select-filter',
//                    'data-type' => 'per'
//                ]
//            ])
//            ->add('high52W', ChoiceType::class, [
//                'choices' => $this->getHigh52W(),
//                'attr' => [
//                    'class' => 'select-filter',
//                    'data-type' => 'high52W'
//                ]
//            ])
//        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RangeFilter::class,
        ]);
    }
}
